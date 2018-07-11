<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/28
 * Time: 17:10
 */
include('header.php');
?>
<span class="zzjz">正在使出吃奶的劲加载中...</span>
<div class="loader">
    <div class="loader-inner">
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
        <div class="loader-line-wrap">
            <div class="loader-line"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="address">
        <ol class="breadcrumb">
            当前位置：
            <li><a href="/">主页</a></li>
            <li class="active">直播</li>
        </ol>
    </div>
    <div class="info">
        <h3 class="name"></h3>
    </div>
    <div id="video">
        <?php
        if (equipment_UA() == "PC") {
            ?>
            <iframe id="ifrvideo" allowfullscreen="true" scrolling="no" allowtransparency="true" src=""
                    style="width:100%;border:none;height: 50%;"></iframe>
        <?php } elseif (equipment_UA() == "Phone") {
            ?>
            <video id="ifrvideo" src="" controls="controls" width="100%" height="100%"
                   x-webkit-airplay="allow"></video>
        <?php } ?>
    </div>
    <div id="playlist">
        <ul></ul>
    </div>
</div>
<?php include('footer.php'); ?>

</body>
<?php
if (equipment_UA() == "PC") {
    ?>
    <script src="<?php echo "/template/" . $template ?>/js/zhiboPC.js"></script>
<?php } elseif (equipment_UA() == "Phone") {
    ?>
    <script src="<?php echo "/template/" . $template ?>/js/zhiboPhone.js"></script>
<?php } ?>

</html>
