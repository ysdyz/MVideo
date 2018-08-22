<?php
$url = isset($_GET['url']) ? $_GET['url'] : '';
if ($url == '') {
    exit('请输入视频地址');
}
?>
<body>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="referrer" content="never">
    <title>播放器</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="js/DPlayer.min.css">
    <style type="text/css">
        body, html, .dplayer {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            color: #999;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        #a1, #loading, #error {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            color: #999;
        }
    </style>
</head>
<body>
<div id="player" class="dplayer"></div>
<script type="text/javascript" src="js/hls.min.js"></script>
<script type="text/javascript" src="js/DPlayer.min.js" charset="utf-8"></script>
<script src="js/flv.min.js"></script>
<script type="text/javascript">
    var isiPad = navigator.userAgent.match(/iPad|iPhone|Android|Linux|iPod/i) != null;
    if (isiPad) {
        document.getElementById('player').innerHTML = '<video src="<?php echo $url ?>" controls="controls" width="100%" height="100%" x-webkit-airplay="allow"></video>';
    } else {
        var pic = "";
        var dplayer = new DPlayer({
            element: document.getElementById("player"),
            autoplay: true,
            video: {
                url: '<?php echo $url ?>',
                pic: pic
            }
        });
    }
</script>
</body>
</html>