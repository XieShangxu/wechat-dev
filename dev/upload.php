<?php
require_once "./jssdk/jssdk.php";
$jssdk = new JSSDK("wxb425e6f4c4d92620", "f18a150963671981cf99684490bf1fdf");
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
    <style>
        * { margin: 0; padding: 0; }
        #container { padding: 20px; }
        #upload-btn { height: 40px; line-height: 40px; text-align: center; color: #fff; background-color: #04be02; border-radius: 4px; }
    </style>
</head>
<body>
    <div id="container">
        <!-- <input type="file" /> -->
        <p id="upload-btn">Upload</p>
    </div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="https://cdn.bootcss.com/zepto/1.0rc1/zepto.min.js"></script>
<script>
    wx.config({
        debug: true,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            "chooseImage",
            "previewImage",
            "uploadImage",
            "downloadImage"
        ]
    });
    $(function() {
        $('#upload-btn').on('click', function() {
            wx.chooseImage({
                success: function(res) {
                    console.log(res);
                }
            })
        })
    })
</script>
</html>