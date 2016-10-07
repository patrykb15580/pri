<?php
/**
* 
*/
class CodeChecker
{
	
	public function checkCodeExist($params)
	{
		$code_arr = PromotionCode::where('code=?', ['code'=>$params['code']]);
		if (!empty($code_arr)) {
			return $code_arr[0];
		}else return null;
	}
}