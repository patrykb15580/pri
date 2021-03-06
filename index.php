<?php
include 'core/Config.php';
include 'config/application.php';
include 'core/AutoLoader.php';
include 'config/routing.php';
require __DIR__ . '/vendor/autoload.php';

session_start();

$db_setup = 'db_'.Config::get('env');
		
MyDB::connect(Config::get($db_setup));
if ($match) {
	list($controller_name, $controller_action) = explode('#', $match['target']);
	$params = $match['params'];
	$params["controller"] = $controller_name;
	$params["action"] = $controller_action;
	if ($_POST) {
		$params = array_merge($params, $_POST);
	}
	if ($_GET) {
		$params = array_merge($params, $_GET);
	}
	$controller = new $controller_name($params);
	
	echo $controller->$controller_action($params);
}

// call closure or throw 404 status

else {
	// no route was matched
	header("HTTP/1.0 404 Not Found");
	include 'app/views/layouts/404.php';
}