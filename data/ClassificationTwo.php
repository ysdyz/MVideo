<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/6/28
 * Time: 14:59
 */
class ClassificationTwo{
	public function switch($id){
		switch ($id) {
			case '1':
				return '电影 - ';
				break;
			case '2':
				return '连续剧 - ';
				break;
			case '3':
				return '综艺 - ';
				break;
			case '4':
				return '动漫 - ';
				break;
			case '5':
				return '动作片 - ';
				break;
			case '6':
				return '喜剧片 - ';
				break;
			case '7':
				return '爱情片 - ';
				break;
			case '8':
				return '科幻片 - ';
				break;
			case '9':
				return '恐怖片 - ';
				break;
			case '10':
				return '剧情片 - ';
				break;
			case '11':
				return '战争片 - ';
				break;
			case '12':
				return '国产剧 - ';
				break;
			case '13':
				return '港台剧 - ';
				break;
			case '14':
				return '日韩剧 - ';
				break;
			case '15':
				return '欧美剧 - ';
				break;
			case '16':
				return '福利 - ';
				break;
			case '17':
				return '伦理片 - ';
				break;
			default:
				# code...
				break;
		}
	}
}
?>