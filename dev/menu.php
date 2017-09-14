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
// $data = '{"button":[{"name":"集团","sub_button":[{"type":"view","name":"品牌历史","url":"http://www.danielxie.xyz/natuzzi/new/history.html"},{"type":"view","name":"活动资讯","url":"http://www.danielxie.xyz/natuzzi/new/groupinfo/index.html"},{"type":"view","name":"官网","url":"http://www.natuzzi.com"},{"type":"view","name":"专卖店","url":"http://www.danielxie.xyz/natuzzi/new/contactus/index.html"}]},{"name":"产品","sub_button":[{"type":"view","name":"Natuzzi Italia","url":"http://www.danielxie.xyz/natuzzi/new/italia/"},{"type":"view","name":"Natuzzi Re-vive","url":"http://www.danielxie.xyz/natuzzi/new/revive/"},{"type":"view","name":"Natuzzi Editions","url":"http://www.danielxie.xyz/natuzzi/new/editions/"}]},{"name":"设计圈","sub_button":[{"type":"view","name":"设计师注册","url":"http://testnatuzzi.kk3k.net/html"},{"type":"view","name":"设计师主页","url":"http://testnatuzzi.kk3k.net/html/?1"},{"type":"click","name":"设计案例展示","key":"button-14"},{"type":"view","name":"最新活动","url":"http://www.aki.com.cn/natuzzi"}]}]}';
$data = '{"button":[{"name":"上传身份证",type:"view","url":"http://www.danielxie.xyz/wechat-dev/dev/upload.html"]}';
$re = post($url,$data);
print_r(json_decode($re));
echo '<hr />';

$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$ac_token;
$re = post($url,'');
print_r(json_decode($re));

/*
$url = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.$ac_token;
$data = '"articles": [{"thumb_media_id":"0ATT97Ff1tzpy5PxAdhvaoTifms93_B2GzcyuzU_5W7ptcgCGxs0gRobdeA0fUT-X2LEYmTxOHkOrU6VZfse3g","author":"","title":"#你关注，我送礼#LIVEMOOK活动来袭！七夕，小编亲手为你送迪奥DIOR","content_source_url":"http://appimg.tuolar.com/face/livemook/0725.html","content":"这周五开始，拉阔时尚LIVEMOOK为了感谢回馈一直以来支持的粉丝，将进行第二波活动！#你关注，我送礼#，猛戳内容，看活动详情~","digest":"digest"}]';
$re = post($url,$data);
print_r(json_decode($re));
*/


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