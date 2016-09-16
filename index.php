<?php
include 'core/Config.php';
include 'config/application.php';
include 'core/AutoLoader.php';
include 'config/routing.php';

$db_setup = 'db_'.Config::get('env');
		
MyDB::connect(Config::get($db_setup));
if ($match) {
	list($controller_name, $controller_action) = explode('#', $match['target']);
	$controller = new $controller_name;
	$params = $match['params'];
	$params["controller"] = $controller_name;
	$params["action"] = $controller_action;
	if ($_POST) {
		$params = array_merge($params, $_POST);
	}
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