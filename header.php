<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/30
 * Time: 10:42
 */
$id = isset($_GET['id']) ? $_GET['id'] : 'index';
include("data/readcontent.class.php");
?>
<html>
<head>
    <?php if (stristr($_SERVER['PHP_SELF'], 'play') != false) { 
            $readcontent = new Read_content();
            $contenturl = "http://zuida.me/" . "?m=vod-detail-id-" . $_GET['id'] . ".html";
            $contentInfo = $readcontent->MloocCurl($contenturl);
            $ruleMatchDetailInList = "~<h2>(.*?)<\/h2>~";#正则表达式
            preg_match($ruleMatchDetailInList, $contentInfo, $title);
            $ruleMatchDetailInList = "~<span class=\"more\" txt=\"(.*?)\">~";#正则表达式
            preg_match($ruleMatchDetailInList, $contentInfo, $drama);
        } 
    ?>
    <title><?php if (stristr($_SERVER['PHP_SELF'], 'search') != false) {echo "搜索 - ";} elseif (stristr($_SERVER['PHP_SELF'],'index' ) != false) {if ($id == '1') {echo '电影 - ';} elseif ($id == '2') {echo '肥皂剧 - ';} elseif ($id == '3') {echo '综艺 - ';} elseif ($id == '4') {echo '动漫 - ';} elseif ($id == '16') {echo '福利 - ';} elseif ($id == '17') {echo '伦理剧 - ';} }elseif(stristr($_SERVER['PHP_SELF'], 'play') != false){echo $title[1].' - ';}?>MVideo</title>
    <meta name="keywords" content="<?php if (stristr($_SERVER['PHP_SELF'],'index' ) != false || stristr($_SERVER['PHP_SELF'],'search' ) != false) {echo 'MVideo,Mlooc Video';}elseif(stristr($_SERVER['PHP_SELF'], 'play') != false){echo $title[1];}?>">
    <meta name="description" content="<?php if (stristr($_SERVER['PHP_SELF'],'index' ) != false || stristr($_SERVER['PHP_SELF'],'search' ) != false) {echo 'MVideo自动采集影视系统,免费看全网视频。';}elseif(stristr($_SERVER['PHP_SELF'], 'play') != false){echo $drama[1];}?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="//cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php if (stristr($_SERVER['PHP_SELF'], 'play') != false) { 
            echo "<style>.container{display:none}</style>";
            $readcontent = new Read_content();
            $contenturl = "http://zuida.me/" . "?m=vod-detail-id-" . $_GET['id'] . ".html";
            $contentInfo = $readcontent->MloocCurl($contenturl);
            $ruleMatchDetailInList = "~<h2>(.*?)<\/h2>~";#正则表达式
            preg_match($ruleMatchDetailInList, $contentInfo, $title);
        } 
    ?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#example-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Mlooc Video</a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/list/1">电影</a></li>
                <li><a href="/list/2">肥皂剧</a></li>
                <li><a href="/list/3">综艺</a></li>
                <li><a href="/list/4">动漫</a></li>
                <li><a href="/list/16">福利</a></li>
                <li><a href="/list/17">伦理剧</a></li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon btn btn-primary "><span
                                class="glyphicon glyphicon-search"></span></span>
                </div>
            </form>
        </div>
    </div>
</nav>
<script>
    $(function () {
        $('.btn-primary').click(function () {
            var key = $('.form-control').val();
            if (key != '' && key != null) {
                window.location = '/search/' + key
            }
        });
        $('.form-control').keyup(function () {
            if (event.keyCode == 13) {
                $(".btn-primary").trigger("click");
            }
        });
    });
</script>