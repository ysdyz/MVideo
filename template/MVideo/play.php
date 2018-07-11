<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/28
 * Time: 17:10
 */
include('header.php');
include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
$selfUrl = $_SERVER['PHP_SELF'];
$listId = play_classification();
?>
<?php
if ($configs['Sensitive'] == true) {
    if ($listId == '16' || $listId == '17') {
        if (isset($_COOKIE["fulilunliju"])) {
            if ($_COOKIE["fulilunliju"] != $configs['Sensitive_password']) {
                exit('<div class="mingganziyuan">敏感资源已被屏蔽！</div>');
            }
        } else {
            exit('<div class="mingganziyuan">敏感资源已被屏蔽！</div>');
        }
    }
}
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
            <li>
                <a href="/list/<?php echo $listId; ?>"><?php echo play_classtitle(); ?></a>
            </li>
            <li class="active"><?php echo play_title(); ?></li>
        </ol>
    </div>
    <div class="info">
        <h3 class="name"><?php echo play_title(); ?></h3>
        <p class="drama"><?php echo play_drama(); ?></p>
    </div>
    <div id="video">
        <iframe id="ifrvideo" allowfullscreen="true" scrolling="no" allowtransparency="true" src=""
                style="width:100%;border:none;height: 50%;"></iframe>
    </div>
    <div id="playlist">
        <ul></ul>
    </div>
</div>
<?php include('footer.php'); ?>

</body>
<script>
    var id = '<?php echo $_GET['id'] ?>';
</script>
<script src="<?php echo "/template/" . $template ?>/js/play.js"></script>
</html>
