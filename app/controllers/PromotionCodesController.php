<?php
/**
* 
*/
class PromotionCodesController extends Controller
{

	/*public function create()
	{
		$codes_arr = [];
		for ($i=0; $i < $this->params['promotion_codes_package']['quantity']; $i++) { 
			$code_package = new PromotionCodesGenerator;
			array_push($codes_arr, $code_package->promotionCodeGenerator(6));
		}
		foreach ($codes_arr as $promotion_code) {
			$this->params['promotion_codes_package']['code'] = $promotion_code;
			#echo "<pre>";
			#die(print_r($this->params));
			$code = new PromotionCode($this->params['promotion_codes_package']);
			$code->save();
		}
	}*/
}