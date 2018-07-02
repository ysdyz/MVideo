<?php
/**
 * Created by PhpStorm.
 * User: Filmy
 * Date: 2018/7/02
 * Time: 09:30
 */
class Classification{
	public function switch($classification){
		switch ($classification) {
			case '电影':
				return '1';
				break;
			case '连续剧':
				return '2';
				break;
			case '综艺':
				return '3';
				break;
			case '动漫':
				return '4';
				break;
			case '动作片':
				return '5';
				break;
			case '喜剧片':
				return '6';
				break;
			case '爱情片':
				return '7';
				break;
			case '科幻片':
				return '8';
				break;
			case '恐怖片':
				return '9';
				break;
			case '剧情片':
				return '10';
				break;
			case '战争片':
				return '11';
				break;
			case '国产剧':
				return '12';
				break;
			case '港台剧':
				return '13';
				break;
			case '日韩剧':
				return '14';
				break;
			case '欧美剧':
				return '15';
				break;
			case '福利':
				return '16';
				break;
			case '伦理片':
				return '17';
				break;
			default:
				# code...
				break;
		}
	}
}
?>