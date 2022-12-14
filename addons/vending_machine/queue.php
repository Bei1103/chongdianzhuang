<?php


error_reporting(0);
require dirname(__FILE__).'/../../framework/bootstrap.inc.php';
require IA_ROOT.'/addons/vending_machine/defines.php';
require IA_ROOT.'/addons/vending_machine/core/inc/functions.php';
require IA_ROOT.'/addons/vending_machine/core/inc/plugin_model.php';
require IA_ROOT.'/addons/vending_machine/core/inc/com_model.php';

class Queue
{

    public $tableName = 'vending_machine_queue';
    public $channel = 'queue';

    public $deleteReleased = true;


    private $_workerPid;

    public function __construct()
    {
        spl_autoload_register(array('self', 'autoload'), true, true);
    }


    public static function autoload($className)
    {

        $classFile = VENDING_MACHINE_PATH. str_replace('\\', '/', $className) . '.php';

        if ($classFile === false || !is_file($classFile)) {
            return;
        }

        include $classFile;
    }

    /**
     * Listens queue and runs each job.
     *
     * @param bool $repeat whether to continue listening when queue is empty.
     * @param int $timeout number of seconds to sleep before next iteration.
     * @return null|int exit code.
     * @internal for worker command only
     * @since 2.0.2
     */
    public function run($repeat, $timeout = 0)
    {
        return $this->runWorker(function (callable $canContinue) use ($repeat, $timeout) {
            while ($canContinue()) {
                if ($payload = $this->reserve()) {
                    if ($this->handleMessage(
                        $payload['id'],
                        $payload['job'],
                        $payload['ttr'],
                        $payload['attempt']
                    )) {
                        $this->release($payload);
                    }
                } elseif (!$repeat) {
                    break;
                } elseif ($timeout) {
                    sleep($timeout);
                }
            }
        });
    }



    /**
     * Runs worker.
     *
     * @param callable $handler
     * @return null|int exit code
     * @since 2.0.2
     */
    protected function runWorker(callable $handler)
    {
        $this->_workerPid = getmypid();

        /** @var SignalLoop $loop */
        $loop = new SignalLoop($this);

        file_put_contents(VENDING_MACHINE_CORE.'queue.pid',$this->_workerPid);
        if (function_exists('chmod')){
            chmod(VENDING_MACHINE_CORE.'queue.pid',0777);
        }

        $exitCode = null;
        try {
            call_user_func($handler, function () use ($loop) {
                return $loop->canContinue();
            });
        } finally {
            $this->_workerPid = null;
        }

        return null;
    }



    /**
     * Takes one message from waiting list and reserves it for handling.
     *
     * @return array|false payload
     * @throws Exception in case it hasn't waited the lock
     */
    protected function reserve()
    {
        $payload = pdo_fetch("SELECT * FROM ".tablename($this->tableName)." WHERE `channel`='{$this->channel}' AND `reserved_at` IS NULL AND `pushed_at`<=:time - delay ORDER BY `priority` ASC, `id` ASC limit 1",array(':time'=>time()));
        if (is_array($payload)) {
            $payload['reserved_at'] = time();
            $payload['attempt'] = (int) $payload['attempt'] + 1;

            pdo_update($this->tableName,array(
                'reserved_at' => $payload['reserved_at'],
                'attempt' => $payload['attempt'],
            ),array(
                'id' => $payload['id'],
            ));

            // pgsql
            if (is_resource($payload['job'])) {
                $payload['job'] = stream_get_contents($payload['job']);
            }
        }

        return $payload;
    }


    protected function handleMessage($id, $message, $ttr, $attempt)
    {

        list($job, $error) = $this->unserializeMessage($message);

        if (empty($job)){
            return false;
        }
        $job->execute($this);
        return true;
    }

    /**
     * @param $serialized
     * @return array
     */
    public function unserializeMessage($serialized)
    {

        try {
            $job = unserialize($serialized);
        } catch (\Exception $e) {
            return array(null, new Exception($serialized, $e->getMessage(), 0, $e));
        }
        return array($job, null);
    }


    /**
     * @param array $payload
     */
    protected function release($payload)
    {
        if ($this->deleteReleased) {
            pdo_delete($this->tableName,array('id' => $payload['id']));
        } else {
            pdo_update($this->tableName,array('done_at' => time()), array('id' => $payload['id']));
        }
    }


    public function fileGlob($path,$recursive = true){
        $res = array();
        if (substr($path,-1) !== '*')
        {
            $path = $path.'*';
        }
        foreach(glob($path) as $file){
            if($file != '.' && $file != '..'){
                $relative_path = str_replace(VENDING_MACHINE_PATH,'',$file);
                if(is_dir($file)){
                    if ($recursive)
                    {
                        $res = array_merge($res,$this->fileGlob($file . '/*',$recursive));
                    }
                }else{
                    $res[$relative_path] = $file;
                }
            }
        }
        return $res;
    }
}


/**
 * Signal Loop.
 *
 * @author Roman Zhuravlev <zhuravljov@gmail.com>
 * @since 2.0.2
 */
class SignalLoop
{
    /**
     * @var array of signals to exit from listening of the queue.
     */
    public $exitSignals = array(
        15, // SIGTERM
        2,  // SIGINT
        1,  // SIGHUP
    );
    /**
     * @var array of signals to suspend listening of the queue.
     * For example: SIGTSTP
     */
    public $suspendSignals = array();
    /**
     * @var array of signals to resume listening of the queue.
     * For example: SIGCONT
     */
    public $resumeSignals = array();

    /**
     * @var Queue
     */
    protected $queue;

    /**
     * @var bool status when exit signal was got.
     */
    private static $exit = false;
    /**
     * @var bool status when suspend or resume signal was got.
     */
    private static $pause = false;


    /**
     * @param Queue $queue
     * @inheritdoc
     */
    public function __construct($queue)
    {
        $this->queue = $queue;
    }

    /**
     * Sets signal handlers.
     *
     * @inheritdoc
     */
    public function init()
    {
        if (extension_loaded('pcntl')) {
            foreach ($this->exitSignals as $signal) {
                pcntl_signal($signal, function () {
                    self::$exit = true;
                });
            }
            foreach ($this->suspendSignals as $signal) {
                pcntl_signal($signal, function () {
                    self::$pause = true;
                });
            }
            foreach ($this->resumeSignals as $signal) {
                pcntl_signal($signal, function () {
                    self::$pause = false;
                });
            }
        }
    }

    /**
     * Checks signals state.
     *
     * @inheritdoc
     */
    public function canContinue()
    {
        if (extension_loaded('pcntl')) {
            pcntl_signal_dispatch();
            // Wait for resume signal until loop is suspended
            while (self::$pause && !self::$exit) {
                usleep(10000);
                pcntl_signal_dispatch();
            }
        }

        return !self::$exit;
    }
}
$queue = new Queue();
$queue->run(true,3);
