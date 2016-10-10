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
	
	$controller->$controller_action($params);
	#echo "<pre>";
	#die(print_r($match));
	#die(print_r($params));
}

// call closure or throw 404 status

else {
	// no route was matched
	print_r('404 Not Found');
}