<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/29
 * Time: 8:25
 */
header('Content-type:text/json');
include("readcontent.class.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/config.php");
function read_info()
{
    $readcontent = new Read_content();
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $pg = isset($_GET['pg']) ? $_GET['pg'] : '1';
    if ($id == '' || $id == 'index') {
        $url = "http://zuida.me?m=vod-index-pg-" . $pg . ".html";#/?m=vod-type-id-2-pg-" . $_GET['pg'] . ".html
    } else {
        $url = "http://zuida.me/?m=vod-type-id-" . $id . "-pg-" . $pg . ".html";#/?m=vod-type-id-2-pg-" . $_GET['pg'] . ".html
    }
    $listcontent = $readcontent->MloocCurl($url);
    $ruleMatchDetailInList = "~<a href=\"(.*?)\" target=\"_blank\">(.*?)<\/a><\/span>~";#正则表达式
    preg_match_all($ruleMatchDetailInList, $listcontent, $title_id);
    $ruleMatchDetailInList = "~<span class=\"xing_vb5\">(.*?)<\/span>~";#正则表达式
    preg_match_all($ruleMatchDetailInList, $listcontent, $category);
    $ruleMatchDetailInList = "~<span class=\"xing_vb[6-7]\">(.*?)<\/span>~";#正则表达式
    preg_match_all($ruleMatchDetailInList, $listcontent, $date);
    $read_json['status'] = "success";
    if ($title_id[1] != "") {
        $xunhuan = count($title_id[1]);
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
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $pg = isset($_GET['pg']) ? $_GET['pg'] : '1';
    if ($id == '' || $id == 'index') {
        $url = "http://zuida.me?m=vod-index-pg-" . $pg . ".html";#/?m=vod-type-id-2-pg-" . $_GET['pg'] . ".html
    } else {
        $url = "http://zuida.me/?m=vod-type-id-" . $id . "-pg-" . $pg . ".html";#/?m=vod-type-id-2-pg-" . $_GET['pg'] . ".html
    }
    $listcontent = $readcontent->MloocCurl($url);
    $ruleMatchDetailInList = "~<a href=\"(.*?)\" target=\"_blank\">(.*?)<\/a><\/span>~";#正则表达式
    preg_match_all($ruleMatchDetailInList, $listcontent, $title_id);
    $ruleMatchDetailInList = "~<span class=\"xing_vb5\">(.*?)<\/span>~";#正则表达式
    preg_match_all($ruleMatchDetailInList, $listcontent, $category);
    $ruleMatchDetailInList = "~<span class=\"xing_vb[6-7]\">(.*?)<\/span>~";#正则表达式
    preg_match_all($ruleMatchDetailInList, $listcontent, $date);
    $read_json['status'] = "success";
    if ($title_id[1] != "") {
        $xunhuan = count($title_id[1]);
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