<?php
/**
* 
*/
class PromotionCodesController
{

	public function create($params)
	{
		$codes_arr = [];
		for ($i=0; $i < $params['promotion_codes_package']['quantity']; $i++) { 
			$code_package = new PromotionCodesGenerator;
			array_push($codes_arr, $code_package->promotion_code_generator(6));
		}
		foreach ($codes_arr as $promotion_code) {
			$params['promotion_codes_package']['code'] = $promotion_code;
			#echo "<pre>";
			#die(print_r($params));
			$code = new PromotionCode($params['promotion_codes_package']);
			$code->save();
		}
	}
}