<?php
//连接小潘ws
require_once VENDING_MACHINE_VENDOR . 'websocket/vendor/autoload.php';
use WebSocket\Client;

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class WebSocket_ComModel extends ComModel
{

    public function app_send($data=array())
    {
        global $_W;
        if(empty($data)||empty($data['action'])){
            return error(-1,'请求参数不正确');
        }

        $client = new Client("ws://127.0.0.1:8787");
        //登录
        $client->send(json_encode(array('action'=>'login','type'=>'app','mid'=>$_W['mid'],'openid'=>$_W['openid'],'uniacid'=>$_W['uniacid'])));
        $res=$client->receive();
        if($res['action']==$data['login']){
            if($res['code']!=1){
                return error(-1, $res['msg']);
            }
        }

        //发送请求
        $data['type']='app';
        $data['uniacid']=$_W['uniacid'];
        $client->send(json_encode($data));
        $res=$client->receive();
        //file_put_contents(VENDING_MACHINE_PATH.time().'.txt',var_export($res,true));
        $res=json_decode($res,true);
        //print_r($res);
        //file_put_contents(VENDING_MACHINE_PATH.$res['action'].'.txt',var_export($res,true));
        if($res['action']==$data['action']){
            if($res['code']==1){
                return $res['data'];
            }else{
                return error(-1, $res['msg']);
            }
        }
        $client->close();
        return error(-1, '未知错误');
    }

    public function web_send($data=array(),$type=0)//0后台 1手机端后台 2商户手机端后台
    {
        global $_W;
        if(empty($data)||empty($data['action'])){
            return error(-1,'请求参数不正确');
        }

        $client = new Client("ws://127.0.0.1:8787");
        //登录
        if($type==1) {
            $client->send(json_encode(array('action' => 'login', 'type' => 'web', 'uid' => $_W['mmanage']['uid'], 'username' => $_W['mmanage']['username'], 'currentvisit' => $_W['mmanage']['lastvisit'], 'uniacid' => $_W['uniacid'])));
        }elseif($type==2){
            $client->send(json_encode(array('action' => 'login', 'type' => 'web', 'merchid' => $_W['merchmanage']['merchid'], 'username' => $_W['merchmanage']['username'], 'currentvisit' => $_W['merchmanage']['lastvisit'], 'uniacid' => $_W['uniacid'],'pwd'=>$_W['merchmanage']['pwd'])));
        }else{
            $client->send(json_encode(array('action' => 'login', 'type' => 'web', 'uid' => $_W['uid'], 'username' => $_W['username'], 'currentvisit' => $_W['user']['currentvisit'], 'uniacid' => $_W['uniacid'])));
        }
        $res=$client->receive();

        if($res['action']==$data['login']){
            if($res['code']!=1){
                return error(-1, $res['msg']);
            }
        }

        //发送请求
        $data['type']='web';
        $data['uniacid']=$_W['uniacid'];
        $client->send(json_encode($data));
        $res=$client->receive();
        if(!$res){
            return error(-1, '请求无应答');
        }
        //file_put_contents(VENDING_MACHINE_PATH.time().'.txt',var_export($res,true));
        $res=json_decode($res,true);
        //print_r($res);
        //file_put_contents(VENDING_MACHINE_PATH.$res['action'].'.txt',var_export($res,true));
        if($res['action']==$data['action']){
            if($res['code']==1){
                return $res['data'];
            }else{
                return error(-1, $res['msg']);
            }
        }
        $client->close();
        return error(-1, '未知错误');
    }

    public function check_status(){
        $client = new Client(self::$ws);
        $client->send('');
        $status=$client->isConnected();
        $client->close();
        return $status;
    }
}