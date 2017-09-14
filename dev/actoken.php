<?php

// appID:       wxb425e6f4c4d92620
// appsecret:   f18a150963671981cf99684490bf1fdf

class Weixin{
    private $appID = "wxb425e6f4c4d92620";
    private $appsecret  = "f18a150963671981cf99684490bf1fdf";

    function getAccessToken(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appID}&secret={$this->appsecret}";

        // return $this->httpGet($url);
        //json字符串
        $json = $this->httpGet($url);
        //解析json
        $obj = json_decode($json);
        return $obj->access_token;
    }

    function httpGet($url){
        //1.初始化
        $curl = curl_init();
        //配置curl
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //执行curl
        $res = curl_exec($curl);
        //关闭curl
        curl_close($curl);
        return $res;
    }
}
$wx = new Weixin();
echo $wx->getAccessToken();

?>