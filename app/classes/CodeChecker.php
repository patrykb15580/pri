<?php
/**
* 
*/
class CodeChecker
{
	
	public static function checkCodeExist($params)
	{
		$code = Code::findBy('code', $params['code']);
		if (!empty($code)) {
			return $code;
		}else return null;
	}
}