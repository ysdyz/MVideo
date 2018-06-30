<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/29
 * Time: 8:25
 */

include("readcontent.class.php");

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

    if ($title_id[1][1] != "") {
        echo "{\"status\":\"success\",\"result\":[";
        $xunhuan = count($title_id[1]);
        for ($i = 0; $i < $xunhuan; $i++) {
            $title_id[1][$i] = preg_replace('/\/\?m=vod-detail-id-(\d+)\.html/i', '$1', $title_id[1][$i]);
//        print_r("<li><span class='title' ><a href='javascript:void(0);' data-id='" . $title_id[1][$i] . "'>" . $title_id[2][$i] . "</a></span><span class='category'>" . $category[1][$i] . "</span><span class='date'>" . $date[1][$i] . "</span></li>");

            echo json_encode(array('title' => $title_id[2][$i], 'id' => $title_id[1][$i], 'category' => $category[1][$i], 'date' => $date[1][$i]));
            if ($i != $xunhuan - 1) {
                echo ",";
            }
        }
        echo "]}";
    } else {
        echo "{\"status\":\"error\"]}";
    }
}

read_info();
?>