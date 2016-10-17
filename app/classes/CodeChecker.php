<?php
/**
* 
*/
class CodeChecker
{
	
	public function checkCodeExist($params)
	{
		$code = PromotionCode::findBy('code', $params['code']);
		if (!empty($code)) {
			return $code;
		}else return null;
	}
}