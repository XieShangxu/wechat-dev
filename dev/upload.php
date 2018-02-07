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
    <script src="./vconsole.min.js"></script>
    <script>
      var vconsole = new VConsole();
    </script>
    <title>Upload</title>
    <style>
        * { margin: 0; padding: 0; }
        #container { padding: 20px; }
        #choose-btn, #upload-btn { height: 40px; line-height: 40px; text-align: center; color: #fff; background-color: #04be02; border-radius: 4px; }
        #upload-btn { display: none; }
        .img-wrapper { margin: 10px 0; }
        .img-wrapper img { display: block; width: 100%; }
    </style>
</head>
<body>
    <div id="container">
        <!-- <input type="file" /> -->
        <p id="choose-btn">选择图片</p>
        <div class="img-wrapper"></div>
        <p id="upload-btn">上传</p>
    </div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="https://cdn.bootcss.com/zepto/1.0rc1/zepto.min.js"></script>
<script>
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            "getLocalImgData",
            "chooseImage",
            "previewImage",
            "uploadImage",
            "downloadImage"
        ]
    });
    $(function() {
        $('#choose-btn').on('click', function() {
            wx.chooseImage({
                success: function(res) {
                    var errMsg = res.errMsg;
                    var imgIds = res.localIds;
                    if (errMsg.indexOf('cancel') > 0) return false;
                    for (var i = 0; i < imgIds.length; i++) {
                        wx.getLocalImgData({
                            localId: imgIds[i],
                            success: function(res) {
                                var localData = res.localData;
                                $('.img-wrapper').append('<img src="' + localData + '" />');
                            }
                        })
                    }
                    $('#upload-btn').show();
                }
            })
        })
    })
</script>
</html>