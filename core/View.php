<?php
/**
* 
*/
class View
{
	public $variables;

	function __construct(Array $params, Array $variables, $layout = 'app')
	{
		
        $this->variables = $variables;
     	

     	$this->variables['params'] = $params;
     	$this->variables['layout'] = $layout;

	}

	public function render()
	{
		
		extract($this->variables);

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $params['controller'])).'/'.$params['action'].'.php';

		#include './app/views/layouts/'.$layout.'.php';

		ob_start();
		require_once('./app/views/layouts/'.$layout.'.php');
		$view = ob_get_contents();
		ob_end_clean();
		#$view = str_replace('<', '&lt', $view);
		#$view = str_replace('>', '&gt', $view);
		#echo "<pre>";
		#print_r($view);

		return $view;
	}
}