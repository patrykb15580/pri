<?php
/**
* 
*/
class Controller
{
	public $params;

	function __construct($params)
	{

		$this->params = $params;
		$controller = StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $params['controller']));

		if ($controller !== 'session') {
			session_start();
			Auth::isLogged();
		}
	}
}