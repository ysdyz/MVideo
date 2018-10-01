<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/30
 * Time: 10:42
 */

?>
<html>
<head>
    <title><?php title(); ?></title>
    <meta name="keywords" content="<?php keywords(); ?>">
    <meta name="description" content="<?php description(); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10"/>
    <meta name="renderer" content="webkit|ie-comp|ie-stand"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/template/MVideo/css/style.css">
    <script src="/template/MVideo/js/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php
    //判断是否为播放页或直播页
    if (stristr($_SERVER['PHP_SELF'], 'play') != false) {
        //隐藏页面内容等待加载完成
        echo "<style>.container{display:none}</style>";
    }
    ?>
    <style id="shebei"></style>

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
            <a class="navbar-brand" href="/"><?php echo $name ?></a>
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
                <?php if (nav() == true) {
                    echo "<li><a href=\"/list/16\">福利</a></li>";
                    echo "<li><a href=\"/list/17\">伦理</a></li>";
                } ?>
            </ul>
            <div class="navbar-form navbar-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon btn btn-primary "><span class="glyphicon glyphicon-search"></span></span>
                </div>
            </div>
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
        <?php
        //判断设备
        if (equipment_UA() == "Phone") {
            echo "$(\".dropdown\").find(\"a:eq(0)\").attr({'href':'#','class':'dropdown-toggle','data-toggle':'dropdown'});";
        } elseif (equipment_UA() == "PC") {
            echo "$('#shebei').text('.navbar .nav > li .dropdown-menu {margin: 1px;}.navbar .nav > li:hover .dropdown-menu {display: block;}');";
        }
        ?>
    });
</script>