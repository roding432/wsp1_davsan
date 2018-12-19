<?php
/*
This is my solution for the laboration that Niklas Mårdby share on his wiki Porkforge.
I've used this laboration to show my pupils how you can work with PHP in developement.
http://porkforge.mardby.se/index.php?title=PHP_Laboration_2_-_Projektstart,_require_och_GET
*/

// We tell the page to require a file called functions
require ('resources/includes/view.php');
require ('resources/includes/model.php');

$error = '';

// Set header correct without using HTML
header("Content-type: text/html; charset=utf-8");

// Get value from url for key page
$page = filter_input(INPUT_GET,'page', FILTER_SANITIZE_URL);



if(empty($page)) {
	$header = 'Start';
	$content = 'Välkommen till Labb 2! Här övar vi på PHP för att bli duktiga webbserverprogrammerare. Detta är andra labben men första labben i en serie labbar som tillsammans bygger vidare på detta projekt som vi påbörjar här. Ett enkelt PHP-projekt men väl strukturerat och genomtänkt konstruerat.';
	include ('resources/templates/page-template.php');
}
elseif($page == "blogg") {
	$header = 'Blogg';
 $template = 'all-blog-posts';
$post = filter_input(INPUT_GET,'post', FILTER_SANITIZE_URL);

// if (empty($post)) {
// 	foreach ($model as $key => $value) {
// 		if ($post == $value ['slug'] ) {
// 			$template = 'singel-blog-post';
// 			$titel=$value['title'];
// 			$auther = $value['auther'];
// 			$date = $value['date'];
// 			$message = $value['message'];

		if(array_key_exists($post, $model)){
			$template = 'single-blog-post';
			$titel=$model[$post]['title'];
			$author = $model[$post]['author'];
			$date = $model[$post]['date'];
			$message = $model[$post]['text'];
		}
	elseif (!empty($post)) {
		$header = 'Error';
		$error = 'Dena sidan existaerar inte';
		$template = 'page';
	}


	include ('resources/templates/'. $template .'-template.php');
}
elseif($page == "kontakt") {
	$header = 'Kontakt';
    $content = 'Du når oss på epost@labb2.se';
    include ('resources/templates/page-template.php');
}
else {
	echo "Den sökta sidan finns inte";
}


?>
