<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/29
 * Time: 11:11
 */
include("readcontent.class.php");
$readcontent = new Read_content();

$contenturl = "http://zuida.me/" . "?m=vod-detail-id-" . $_GET['id'] . ".html";

$contentInfo = $readcontent->MloocCurl($contenturl);
$ruleMatchDetailInList = "~checked=\"\" \/>(.*?)<\/li>~";#正则表达式
preg_match_all($ruleMatchDetailInList, $contentInfo, $content);

$ruleMatchDetailInList = "~<h2>(.*?)<\/h2>~";#正则表达式
preg_match($ruleMatchDetailInList, $contentInfo, $title);

$ruleMatchDetailInList = "~<span class=\"more\" txt=\"(.*?)\">~";#正则表达式
preg_match($ruleMatchDetailInList, $contentInfo, $drama);

$contentCount = count($content[1]);
$m3u8Count = 0;
$mp4Count = 0;
$zlCount = 0;
if ($contentCount != 0) {
    for ($i = 0; $i < $contentCount; $i++) {
        //print_r("<li data='http://v.mlooc.cn/public/player/player.php?url=" .  . "'>" .  . "</li>");
        if (stristr(explode('$', $content[1][$i])[1], "m3u8")) {
            $m3u8Count = $m3u8Count + 1;
        } elseif (stristr(explode('$', $content[1][$i])[1], "mp4") != false) {
            $mp4Count = $mp4Count + 1;
        } elseif (stristr(explode('$', $content[1][$i])[1], "m3u8") == false && stristr(explode('$', $content[1][$i])[1], "mp4") == false) {
            $zlCount = $zlCount + 1;
        }

    }
    echo "{\"status\":\"success\",\"title\":" . json_encode($title[1]) . ",\"drama\":" . json_encode($drama[1]) . ",\"result\":[";
    if ($m3u8Count != 0) {
        for ($i = 0; $i < $m3u8Count; $i++) {
            //print_r("<li data='http://v.mlooc.cn/public/player/player.php?url=" .  . "'>" .  . "</li>");
            echo json_encode(array('url' => '/player/player.php?url=' . explode('$', $content[1][$i])[1], 'collection' => explode('$', $content[1][$i])[0]), JSON_UNESCAPED_SLASHES);
            if ($i != $m3u8Count - 1) {
                echo ",";
            }
        }
        echo "]}";
        exit;
    }
    if ($mp4Count != 0) {
        for ($i = 0; $i < $mp4Count; $i++) {
            //print_r("<li data='http://v.mlooc.cn/public/player/player.php?url=" .  . "'>" .  . "</li>");
            echo json_encode(array('url' => '/player/player.php?url=' . explode('$', $content[1][$i])[1], 'collection' => explode('$', $content[1][$i])[0]), JSON_UNESCAPED_SLASHES);
            if ($i != $mp4Count - 1) {
                echo ",";
            }
        }
        echo "]}";
        exit;
    }
    if ($zlCount != 0) {
        for ($i = 0; $i < $zlCount; $i++) {
            //print_r("<li data='http://v.mlooc.cn/public/player/player.php?url=" .  . "'>" .  . "</li>");
            echo json_encode(array('url' => explode('$', $content[1][$i])[1], 'collection' => explode('$', $content[1][$i])[0]), JSON_UNESCAPED_SLASHES);
            if ($i != $zlCount - 1) {
                echo ",";
            }
        }
        echo "]}";
        exit;
    }
} else {
    echo "{\"status\":\"error\"}";
    exit;
}

?>