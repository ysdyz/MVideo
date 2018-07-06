<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/30
 * Time: 10:42
 */
$id = isset($_GET['id']) ? $_GET['id'] : 'index';
include("data/readcontent.class.php");
include("data/classification.php");
include("data/ClassificationTwo.php");
include('data/pwd.php');
$ClassificationTwoc = new ClassificationTwo();
?>
<html>
<head>
    <?php if (stristr($_SERVER['PHP_SELF'], 'play') != false) {
        $readcontent = new Read_content();
        $classificationc = new Classification();
        $contenturl = "http://zuida.me/" . "?m=vod-detail-id-" . $_GET['id'] . ".html";
        $contentInfo = $readcontent->MloocCurl($contenturl);
        $ruleMatchDetailInList = "~<h2>(.*?)<\/h2>~";#正则表达式
        preg_match($ruleMatchDetailInList, $contentInfo, $title);
        $ruleMatchDetailInList = "~<span class=\"more\" txt=\"(.*?)\">~";#正则表达式
        preg_match($ruleMatchDetailInList, $contentInfo, $drama);
        $ruleMatchDetailInList = "/html\",\"(.*?)\",\"\//s";#正则表达式
        preg_match($ruleMatchDetailInList, $contentInfo, $classification);
    }
    ?>
    <title><?php if (stristr($_SERVER['PHP_SELF'], 'search') != false) {
            echo "搜索 - ";
        } elseif (stristr($_SERVER['PHP_SELF'], 'index') != false) {
            echo $ClassificationTwoc->switch($id);
        } elseif (stristr($_SERVER['PHP_SELF'], 'play') != false) {
            echo $title[1] . ' - ';
        } ?>MVideo</title>
    <meta name="keywords"
          content="<?php if (stristr($_SERVER['PHP_SELF'], 'index') != false || stristr($_SERVER['PHP_SELF'], 'search') != false) {
              echo 'MVideo,Mlooc Video';
          } elseif (stristr($_SERVER['PHP_SELF'], 'play') != false) {
              echo $title[1];
          } ?>">
    <meta name="description"
          content="<?php if (stristr($_SERVER['PHP_SELF'], 'index') != false || stristr($_SERVER['PHP_SELF'], 'search') != false) {
              echo 'MVideo自动采集影视系统,免费看全网视频。';
          } elseif (stristr($_SERVER['PHP_SELF'], 'play') != false) {
              echo $drama[1];
          } ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10"/>
    <meta name="renderer" content="webkit|ie-comp|ie-stand"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="/js/jquery.min.js"></script>
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
    <?php
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $is_pc = (stripos($agent, 'windows nt')) ? true : false;
    $is_iphone = (stripos($agent, 'iphone')) ? true : false;
    $is_ipad = (stripos($agent, 'ipad')) ? true : false;
    $is_android = (stripos($agent, 'android')) ? true : false;
    $id_iPod = (stripos($agent, 'ipod')) ? true : false;
    //输出数据
    if ($is_pc) {
        echo "<style>.navbar .nav > li .dropdown-menu {margin: 1px;}.navbar .nav > li:hover .dropdown-menu {display: block;}</style>";
    }
    ?>

    <!--[if lt IE 9]>
    <style>body {
        overflow-y: hidden;
    }</style>
    <div class="browsehappy" role="dialog"><a href="http://browsehappy.com/">您的浏览器很滑稽，建议点击我升级您的浏览器！</a></div>
    <![endif]-->
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
            <a class="navbar-brand" href="/">MVideo</a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="/list/1">电影 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/list/5">动作片</a></li>
                        <li><a href="/list/6">喜剧片</a></li>
                        <li><a href="/list/7">爱情片</a></li>
                        <li><a href="/list/8">科幻片</a></li>
                        <li><a href="/list/9">恐怖片</a></li>
                        <li><a href="/list/10">剧情片</a></li>
                        <li><a href="/list/11">战争片</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="/list/2">肥皂剧 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/list/12">国产剧</a></li>
                        <li><a href="/list/13">港台剧</a></li>
                        <li><a href="/list/14">日韩剧</a></li>
                        <li><a href="/list/15">欧美剧</a></li>
                    </ul>
                </li>
                <li><a href="/list/3">综艺</a></li>
                <li><a href="/list/4">动漫</a></li>
                <?php if (isset($_COOKIE["fulilunliju"])) {
                    if ($_COOKIE["fulilunliju"] != $password) {

                    } else {
                        echo "<li><a href=\"/list/16\">福利</a></li>";
                        echo "<li><a href=\"/list/17\">伦理</a></li>";
                    }
                } else {

                } ?>
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
        <?php if ($is_iphone || $is_ipad || $is_android || $id_iPod) {
        echo "$(\".dropdown\").find(\"a:eq(0)\").attr({'href':'#','class':'dropdown-toggle','data-toggle':'dropdown'});";
    } ?>

    });
</script>