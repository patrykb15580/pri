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

		include './app/views/layouts/'.$layout.'.php';
	}
}