<?php
/**
* 
*/
class CodeChecker
{
	
	public static function checkCodeExist($params)
	{
		$code = PromotionCode::findBy('code', $params['code']);
		if (!empty($code)) {
			return $code;
		}else return null;
	}
}