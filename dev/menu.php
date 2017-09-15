<?php

header("Content-Type:text/html;charset=utf-8");
//define("TOKEN", "tuolarcom");
//$wechatObj = new wx_tuolarCallbackapi();
//$wechatObj->valid();
//$wechatObj->responseMsg();

//获取access_token
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxb425e6f4c4d92620&secret=f18a150963671981cf99684490bf1fdf";
$ac_token_t = post($url,'');
$ac_token_o = json_decode($ac_token_t);
$ac_token = $ac_token_o->access_token;

echo $ac_token;
echo '<hr />';


//生成菜单
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$ac_token;
$data = '{"button":[{"name":"上传身份证","type":"view","url":"http://www.danielxie.xyz/wechat-dev/dev/upload.php"]}';
$re = post($url,$data);
print_r(json_decode($re));
echo '<hr />';

$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$ac_token;
$re = post($url,'');
print_r(json_decode($re));


function post($url, $jsonData){
    $ch = curl_init($url) ;
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($ch) ;
    curl_close($ch) ;
    return $result;
}

?>