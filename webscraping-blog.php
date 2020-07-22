<?php

require_once './vendor/autoload.php'; 
//use
use Goutte\Client;

$Goutte_client = new Client();
$start_url = 'https://blog.scrapinghub.com';
$next_post_link = "";
$crawler = $Goutte_client->request('GET',$start_url);

while(($next_post = $crawler->filter('a.next-posts-link')->count() ) > 0){
	var_dump($next_post);
	$title = $crawler->filter('.post-header>h2')->each(function($element){

	$post_link = $element->filter('a')->text(); 

	print $post_link . "<br>";
	});

	$next_post = $crawler->filter('a.next-posts-link')->each(function($element){
		global $next_post_link;
		$next_post_link = $element->filter('a')->link()->getUri();
		print($next_post_link . "<br>");
		
		
	});

	$Goutte_client = new Client();
	$crawler = $Goutte_client->request('GET', $next_post_link);

}


