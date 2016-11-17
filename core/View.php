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

	public function render($path = null)
	{
		extract($this->variables);

		if (!$path) {
			$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', $params['controller'])).'/'.$params['action'].'.php';
		}

		ob_start();
		include('./app/views/layouts/'.$layout.'.php');
		$view = ob_get_contents();
		ob_end_clean();

		return $view;
	}
}