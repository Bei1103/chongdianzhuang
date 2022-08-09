<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Laravel_Channel extends Device_Model {

    /**
     * 同步设备的门锁信息
     * @param array $device 设备ID
     * @return boolean|mixed
     */
    public function dosynclock($device){
        return true;
    }

}