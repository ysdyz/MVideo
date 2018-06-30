<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/28
 * Time: 17:10
 */
include('header.php');
?>
<span class="zzjz">正在载入中...</span>
<div class="container">
    <div class="address">
        <ol class="breadcrumb">
            当前位置：
            <li><a href="/">主页</a></li>
            <li class="active"><?php echo $title[1]; ?></li>
        </ol>
    </div>
    <div class="info">
        <h3 class="name"><?php echo $title[1]; ?></h3>
        <p class="drama"><?php echo $drama[1]; ?></p>
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
<script src="/js/play.js"></script>
</html>
