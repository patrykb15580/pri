<?php
/**
* 
*/
class CodeChecker
{
	
	public function check_code_exist($params)
	{
		$code_arr = PromotionCode::where('code=?', ['code'=>$params['code']]);
		if (!empty($code_arr)) {
			return $code_arr[0];
		}else return null;
	}
}