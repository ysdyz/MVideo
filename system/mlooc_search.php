<?php

/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/30
 * Time: 13:28
 */
header('Content-type:text/json');
include("readcontent.class.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
function read_info()
{
    $readcontent = new Read_content();
    $key = isset($_GET['key']) ? $_GET['key'] : '';
    $url = "http://zuida.me/index.php?m=vod-search&wd=" . $key;
    $listcontent = $readcontent->MloocCurl($url);
    if (stristr($listcontent, '请不要频繁操作，时间间隔为5秒') == false) {
        $ruleMatchDetailInList = "~<a href=\"(.*?)\" target=\"_blank\">(.*?)<\/span><\/a><\/span>~";#正则表达式
        preg_match_all($ruleMatchDetailInList, $listcontent, $title_id);
        $ruleMatchDetailInList = "~<span class=\"xing_vb5\">(.*?)<\/span>~";#正则表达式
        preg_match_all($ruleMatchDetailInList, $listcontent, $category);
        $ruleMatchDetailInList = "~<span class=\"xing_vb[6-7]\">(.*?)<\/span>~";#正则表达式
        preg_match_all($ruleMatchDetailInList, $listcontent, $date);
        $xunhuan = count($title_id[1]);
        $read_json['status'] = "success";
        $nullNum = 0;
        for ($i = 0; $i < $xunhuan; $i++) {
            $title_id[1][$i] = preg_replace('/\/\?m=vod-detail-id-(\d+)\.html/i', '$1', $title_id[1][$i]);
            if ((stristr($category[1][$i], '福利') != false) || (stristr($category[1][$i], '伦理片') != false)) {
                $result_json[$i]['title'] = '';
                $result_json[$i]['id'] = '';
                $result_json[$i]['category'] = '';
                $result_json[$i]['date'] = '';
                $nullNum++;
            } else {
                $result_json[$i]['title'] = $title_id[2][$i];
                $result_json[$i]['id'] = $title_id[1][$i];
                $result_json[$i]['category'] = $category[1][$i];
                $result_json[$i]['date'] = $date[1][$i];
            }
        }
        if ($nullNum >= $xunhuan) {
            $read_json['status'] = "error";
            echo json_encode($read_json);
        } else {
            $read_json['result'] = $result_json;
            echo json_encode($read_json);
        }
    } else {
        $read_json['status'] = "error";
        echo json_encode($read_json);
    }
}

function read_infoTwo()
{
    $readcontent = new Read_content();
    $key = isset($_GET['key']) ? $_GET['key'] : '';
    $url = "http://zuida.me/index.php?m=vod-search&wd=" . $key;
    $listcontent = $readcontent->MloocCurl($url);
    if (stristr($listcontent, '请不要频繁操作，时间间隔为5秒') == false) {
        $ruleMatchDetailInList = "~<a href=\"(.*?)\" target=\"_blank\">(.*?)<\/span><\/a><\/span>~";#正则表达式
        preg_match_all($ruleMatchDetailInList, $listcontent, $title_id);
        $ruleMatchDetailInList = "~<span class=\"xing_vb5\">(.*?)<\/span>~";#正则表达式
        preg_match_all($ruleMatchDetailInList, $listcontent, $category);
        $ruleMatchDetailInList = "~<span class=\"xing_vb[6-7]\">(.*?)<\/span>~";#正则表达式
        preg_match_all($ruleMatchDetailInList, $listcontent, $date);
        $xunhuan = count($title_id[1]);
        $read_json['status'] = "success";
        for ($i = 0; $i < $xunhuan; $i++) {
            $title_id[1][$i] = preg_replace('/\/\?m=vod-detail-id-(\d+)\.html/i', '$1', $title_id[1][$i]);
            $result_json[$i]['title'] = $title_id[2][$i];
            $result_json[$i]['id'] = $title_id[1][$i];
            $result_json[$i]['category'] = $category[1][$i];
            $result_json[$i]['date'] = $date[1][$i];
        }
        $read_json['result'] = $result_json;
        echo json_encode($read_json);
    } else {
        $read_json['status'] = "error";
        echo json_encode($read_json);
    }
}

if ($configs['Sensitive'] == true) {
    if (isset($_COOKIE["fulilunliju"])) {
        if ($_COOKIE["fulilunliju"] != $configs['Sensitive_password']) {
            read_info();
            exit();
        }
    } else {
        read_info();
        exit();
    }
}
read_infoTwo();
?>