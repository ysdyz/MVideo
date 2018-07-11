<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/29
 * Time: 11:11
 */
header('Content-type:text/json');
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
$contenf_json['status'] = 'success';
if ($contentCount != 0) {
    for ($i = 0; $i < $contentCount; $i++) {
        if (stristr(explode('$', $content[1][$i])[1], "m3u8")) {
            $m3u8Count = $m3u8Count + 1;
        } elseif (stristr(explode('$', $content[1][$i])[1], "mp4") != false) {
            $mp4Count = $mp4Count + 1;
        } elseif (stristr(explode('$', $content[1][$i])[1], "m3u8") == false && stristr(explode('$', $content[1][$i])[1], "mp4") == false) {
            $zlCount = $zlCount + 1;
        }
    }
    $contenf_json['title'] = $title[1];
    $contenf_json['drama'] = $drama[1];

    if ($m3u8Count != 0) {
        for ($i = 0; $i < $m3u8Count; $i++) {
            $result[$i]['url'] = '//api.mlooc.cn/Mvideo/player/player.php?url=' . explode('$', $content[1][$i])[1];
            $result[$i]['collection'] = explode('$', $content[1][$i])[0];
        }
        $contenf_json['result'] = $result;
        echo json_encode($contenf_json, JSON_UNESCAPED_SLASHES);
        exit;
    }
    if ($mp4Count != 0) {
        for ($i = 0; $i < $mp4Count; $i++) {
            $result[$i]['url'] = '//api.mlooc.cn/Mvideo/player/player.php?url=' . explode('$', $content[1][$i])[1];
            $result[$i]['collection'] = explode('$', $content[1][$i])[0];
        }
        $contenf_json['result'] = $result;
        echo json_encode($contenf_json, JSON_UNESCAPED_SLASHES);
        exit;
    }
    if ($zlCount != 0) {
        for ($i = 0; $i < $zlCount; $i++) {
            $result[$i]['url'] = explode('$', $content[1][$i])[1];
            $result[$i]['collection'] = explode('$', $content[1][$i])[0];
        }
        $contenf_json['result'] = $result;
        echo json_encode($contenf_json, JSON_UNESCAPED_SLASHES);
        exit;
    }
} else {
    $contenf_json['status'] = 'error';
    echo json_encode($contenf_json);
    exit;
}
?>