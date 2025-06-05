<?php 
//setPostViews(get_the_ID());
# Single Episodes
if(get_post_type( get_the_ID() ) ==  'episodes') {
	include_once 'includes/single/episodes.php';
}	
# Single Series
elseif (get_post_type( get_the_ID() ) ==  'tvshows') {
	include_once 'includes/single/tvshows.php';
}
# Single Noticias
elseif (get_post_type( get_the_ID() ) ==  'noticias') {
	include_once 'includes/single/news.php';
} 
elseif (get_post_type( get_the_ID() ) ==  'notices') {
	include_once 'includes/single/notices.php';
} else { 
		include_once 'includes/single/movies.php'; 
}
?>
