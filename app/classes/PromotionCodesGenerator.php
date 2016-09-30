<?php
/**
* 
*/
class PromotionCodesGenerator
{
	public function promotion_code_generator($length) {
	    $characters = 'abcdefghjklmnpqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $code = '';
	    for ($i = 0; $i < $length; $i++) {
	        $code .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $code;
	}
}