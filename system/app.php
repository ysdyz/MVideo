<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/7/11
 * Time: 8:36
 */
include("readcontent.class.php");
include("ification.class.php");
include("ificationTwo.class.php");
$readcontent = new Read_content();
$ClassificationTwoc = new ClassificationTwo();
$name = $configs['name'];
$subtitle = $configs['subtitle'];
$keywords = $configs['keywords'];
$description = $configs['description'];
$template = $configs['template'];
$Sensitive = $configs['Sensitive'];
$Sensitive_password = $configs['Sensitive_password'];
$id = isset($_GET['id']) ? $_GET['id'] : 'index';

if (stristr($_SERVER['PHP_SELF'], "play") != false) {
    $contenturl = "http://zuida.me/" . "?m=vod-detail-id-" . $_GET['id'] . ".html";
    $contentInfo = $readcontent->MloocCurl($contenturl);
}

function play_title()
{
    global $contentInfo;
    $classificationc = new Classification();
    $ruleMatchDetailInList = "~<h2>(.*?)<\/h2>~";#正则表达式
    preg_match($ruleMatchDetailInList, $contentInfo, $title);
    return $title[1];

}

function play_drama()
{
    global $contentInfo;
    $classificationc = new Classification();
    $ruleMatchDetailInList = "~<span class=\"more\" txt=\"(.*?)\">~";#正则表达式
    preg_match($ruleMatchDetailInList, $contentInfo, $drama);
    return $drama[1];

}


function play_classtitle()
{
    global $contentInfo;
    $ruleMatchDetailInList = "/html\",\"(.*?)\",\"\//s";#正则表达式
    preg_match($ruleMatchDetailInList, $contentInfo, $classification);
    return $classification[1];
}

function play_classification()
{
    $classificationc = new Classification();
    return $classificationc->switch(play_classtitle());
}

function title()
{
    $selfUrl = $_SERVER['PHP_SELF'];
    global $id;
    global $name;
    global $subtitle;
    global $ClassificationTwoc;
    if (stristr($selfUrl, "search") != false) {
        echo "搜索 - " . $name;
    } elseif ($id == 'index') {
        echo $name . ' - ' . $subtitle;
    } elseif (stristr($selfUrl, "index") != false) {
        echo $ClassificationTwoc->switch($id) . $name;
    } elseif (stristr($selfUrl, "play") != false) {
        echo play_title() . ' - ' . $name;
    }
}

function keywords()
{
    global $keywords;
    $selfUrl = $_SERVER['PHP_SELF'];
    if (stristr($selfUrl, 'index') != false || stristr($selfUrl, 'search') != false) {
        echo $keywords;
    } elseif (stristr($selfUrl, 'play') != false) {
        echo play_title();
    }
}

function description()
{
    global $description;
    $selfUrl = $_SERVER['PHP_SELF'];
    if (stristr($selfUrl, 'index') != false || stristr($selfUrl, 'search') != false) {
        echo $description;
    } elseif (stristr($_SERVER['PHP_SELF'], 'play') != false) {
        echo play_drama();
    }
}

function equipment_UA()
{
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $is_pc = (stripos($agent, 'windows nt')) ? true : false;
    $is_iphone = (stripos($agent, 'iphone')) ? true : false;
    $is_ipad = (stripos($agent, 'ipad')) ? true : false;
    $is_android = (stripos($agent, 'android')) ? true : false;
    $is_iPod = (stripos($agent, 'ipod')) ? true : false;
    if ($is_pc) {
        return "PC";
    } elseif ($is_iphone || $is_ipad || $is_android || $is_iPod) {
        return "Phone";
    }
}

function nav()
{
    global $Sensitive;
    global $Sensitive_password;
    if ($Sensitive == true) {
        if (isset($_COOKIE["fulilunliju"])) {
            if ($_COOKIE["fulilunliju"] != $Sensitive_password) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    } else {
        return true;
    }
}

?>