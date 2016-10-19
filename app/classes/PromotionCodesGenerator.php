<?php
/**
* 
*/
class PromotionCodesGenerator
{
	public function promotionCodeGenerator($length = 6) {
	    $characters = 'abcdefghjkmnpqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $code = '';

	    for ($i = 0; $i < $length; $i++) {
	        $code = $code.$characters[rand(0, $charactersLength - 1)];
	    }

	    return $code;
	}
}