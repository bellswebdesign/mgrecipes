<?php

//Convert passed parameter string into a slug
function slugify($str, $delimiter = '-'){
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;
}

// Live Reload
function liveReload(){
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        echo '<script type="text/javascript" src="http://localhost:35729/livereload.js?snipver=1"></script>';
    }
}

//Slugify the Page Title
function pageSlug($pageTitle){
    $pageSlug = slugify($pageTitle);
    return $pageSlug;
}

function error_404(){
	header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
	exit();	
}	

function error_500(){
	header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
	exit();
}
function redirect_to($location){
	header("Location: " . $location);
	exit();
}

function is_post_request(){
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}					

function is_get_request(){
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function pageURL(){
    $pageURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $pageURL;
}

?>
