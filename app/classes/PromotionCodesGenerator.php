<?php
/**
* 
*/
class PromotionCodesGenerator
{
	public function promotionCodeGenerator($length) {
	    $characters = 'abcdefghjklmnpqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $code = '';
	    for ($i = 0; $i < $length; $i++) {
	        $code .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $code;
	}
}