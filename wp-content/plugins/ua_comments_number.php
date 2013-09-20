<?php
/*
Plugin Name: Правильне відмінювання кількості коментарів
Plugin URI:
Description: Правильне відмінювання для різних варіацій кількостей коментарів. Перероблений з <a href="http://ulizko.com/russify_comments_number">російської версії</a> автора: <a href="http://ulizko.com">Alexander Ulizko</a>
Version: 1.0.1
Author:  Lilumi
Author URI: http://lilumi.org.ua
*/

function off_comments_number( $post_id = 0 ) {
global $id;
	global $post;
	$c_op=comments_open();
	$number=$post->comment_count;
	
	if(empty($c_op)) 
		$count = -1;
	else
		$count = $number;

return $count;
}

function ua_comments_number($zero = false, $one = false, $more = false, $deprecated = '') {
	global $id;
	$number = get_comments_number($id);
		
	if ($number == -1){
		$output="коментування вимкнено";
	} elseif ($number == 0) {
		$output = 'прокоментуй!';
	} elseif ($number == 1) {
		$output = '1 коментар';
	} elseif (($number > 20) && (($number % 10) == 1)) {
		$output = str_replace('%', $number, '% комментар');
	} elseif ((($number >= 2) && ($number <= 4)) || ((($number % 10) >= 2) && (($number % 10) <= 4)) && ($number > 20)) {
		$output = str_replace('%', $number, '% коментарі');
	} else {
		$output = str_replace('%', $number, '% коментарів');
	}
	echo apply_filters('ua_comments_number', $output, $number);
}



add_filter('get_comments_number', 'off_comments_number');
add_filter('comments_number', 'ua_comments_number');
?>
