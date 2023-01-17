<?php

$uri = isset($_GET['uri']) ? htmlspecialchars($_GET['uri']) : "/";

$paths = [];


function route(string $path = '', callable $get){
	global $paths;
	if (!in_array($path, $paths)) {
		$paths[$path] = $get;
	}
}

function run($uri_path){
	global $paths;
	if (@$paths[$uri_path] != NULL) {
		call_user_func($paths[$uri_path]);
	}else{
		echo '404 page not exist';
	}
}

function view(string $file = '', array $data = []){
	include_once  $file.".php";
	return $data;
}


route('about',function(){
	$data['title'] = 'About us';
	view('about',$data);
});


run($uri);