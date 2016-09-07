<?php
/**
* 
*/
class PromotorsController
{
	public function show($params)
	{
		$promotor = Promotor::find($params['id']);

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/app.php';
		
	}
}