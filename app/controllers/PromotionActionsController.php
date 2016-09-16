<?php
/**
* 
*/
class PromotionActionsController
{
	public function show($params)
	{
		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include './app/views/layouts/app.php';
		
	}
	public function new($params)
	{
		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include './app/views/layouts/app.php';
	}
}