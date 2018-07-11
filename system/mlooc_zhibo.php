<?php

/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/7/10
 * Time: 18:11
 */
header('Content-type:text/json');
include("readcontent.class.php");
$readcontent = new Read_content();
$contenturl = "http://ivi.bupt.edu.cn";
$contentInfo = $readcontent->MloocCurl($contenturl);
$ruleMatchDetailInList = "~<p>(.*?)<\/p>~";#正则表达式
preg_match_all($ruleMatchDetailInList, $contentInfo, $title);

$ruleMatchDetailInList = '/<a([^>]*?)href=[\'"]([^\'"]*?)[\'"]([^>]*?)>PC端<\/a>/s';#正则表达式
preg_match_all($ruleMatchDetailInList, $contentInfo, $pcurl);

$ruleMatchDetailInList = '/<a([^>]*?)href=[\'"]([^\'"]*?)[\'"]([^>]*?)>移动端<\/a>/s';#正则表达式
preg_match_all($ruleMatchDetailInList, $contentInfo, $phoneurl);

// print_r($title[1]);
// print_r($pcurl[2]);
// print_r($phoneurl[2]);

if (count($title[1])>0) {
	
	for ($i=0; $i < count($title[1]); $i++) { 
		$titleinfo[$i]=$title[1][$i];
		$pcinfo[$i]=$contenturl.$pcurl[2][$i];
		$phoneinfo[$i]=$contenturl.$phoneurl[2][$i];
	}
	$infojson['msg']='success';
	$infojson['title']=$titleinfo;
	$infojson['pc']=$pcinfo;
	$infojson['phone']=$phoneinfo;
	echo json_encode($infojson,JSON_UNESCAPED_SLASHES);
}else{
	$infojson['msg']='error';
	echo json_encode($infojson,JSON_UNESCAPED_SLASHES);
}
?>