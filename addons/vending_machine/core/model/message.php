<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Message_Model {

    /**
     * 模板消息通知
     */
    public function sendTplNotice($touser, $template_id, $postdata, $url = '', $account = null,$miniprogram=array()) {
        if (!$account) {
            $account = m('common')->getAccount();
        }
        if (!$account) {
      
                return;
        }
//        $account->sendTplNotice($touser, $template_id, $postdata, $url,'#FF683F',$miniprogram);
        return $account->sendTplNotice($touser, $template_id, $postdata, $url,'#FF683F',$miniprogram);
    }

    //根据模板消息发送客服消息
    public function sendCustomNotice($openid, $msg, $url = '', $account = null) { 
     
        {
            if (!$account) {
                $account = m('common')->getAccount();
            }
            if (!$account) {  
                return;
            }  
            $content = "";
            if(is_array($msg)){
                foreach ($msg as $key => $value) {
                    $value['value'] = empty($value['value']) ? "" : $value['value'];
                    if (!empty($value['title'])) {
                        $content.=$value['title'] . ":" . $value['value'] . "\n";
                    } else {
                        $content.=$value['value'] . "\n";
                        if ($key == 0) {
                            $content.="\n";
                        }
                    }
                }
            } else {
                $content = addslashes($msg);
            }
            if (!empty($url)) {
                $content.="<a href='{$url}'>点击查看详情</a>";
            }
           return  $account->sendCustomNotice(array(
                "touser" => $openid,
                "msgtype" => "text",
                "text" => array('content' => urlencode($content))
            ));
          
          
        }
    }
    /**
     * 发送图片
     * @param type $openid
     * @param type $mediaid
     * @return type 
     */
    public function sendImage($openid,$mediaid){
            $account = m('common')->getAccount();
            return $account->sendCustomNotice(array(
                "touser" => $openid,
                "msgtype" => "image",
                "image" => array('media_id' =>$mediaid)
            ));
    }
    public function sendNews($openid,$articles,$account  = null){
	   if(!$account){ 
		$account = m('common')->getAccount();
	   }
            return $account->sendCustomNotice(array(
                "touser" => $openid,
                "msgtype" => "news",
                "news" => array('articles' =>$articles)
            ));
    }

    public function sendTexts($openid,$content, $url = '',$account  = null){
        if(!$account){
            $account = m('common')->getAccount();
        }

        if (!empty($url)) {
            $content.="\n<a href='{$url}'>点击查看详情</a>";
        }

        return  $account->sendCustomNotice(array(
            "touser" => $openid,
            "msgtype" => "text",
            "text" => array('content' => urlencode($content))
        ));
    }

}
