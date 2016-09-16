<?php
/**
* 
*/
class PromotionCodesPackagesController
{
	public function show($params)
	{
		
		$package = PromotionCodesPackage::find($params['id']);

		$action_name = PromotionAction::find($params['action_id']);
		$action_name = $action_name->name;
		
		$promotion_codes = [];

		foreach ($package->promotion_codes() as $code) {
			array_push($promotion_codes, $code);	
		}

		$path = './app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		#die(print_r($path));
		include './app/views/layouts/app.php';
		
	}

	public function new($params)
	{
		$package = new PromotionCodesPackage;
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';

		include 'app/views/layouts/app.php';
	}

	public function create($params)
	{
		$params['promotion_codes_package']['action_id'] = $params['action_id'];
		$package = new PromotionCodesPackage($params['promotion_codes_package']);


		if ($package->save() == false) {
			$package = new PromotionCodesPackage($params['promotion_codes_package']);
			$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.'new.php';
			include 'app/views/layouts/app.php';
		}
		else{
			
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/promotion-actions/".$params['action_id']);
		} 		
	}

	public function edit($params)
	{
		$package = new PromotionCodesPackage;
		$package = PromotionCodesPackage::find($params['action_id']);
		$path = 'app/views/'.StringUntils::camelCaseToUnderscore(str_replace('Controller', '', __CLASS__)).'/'.__FUNCTION__.'.php';
		include 'app/views/layouts/app.php';
	}

	public function update($params)
	{
		if ($params['promotion_action']['indefinitely'] == '1') {
			
			unset($params['promotion_action']['from_at']);
			unset($params['promotion_action']['to_at']);
		}

		$package = PromotionCodesPackage::findBy('id', $params['id']);
		$package->update($params['promotion_action']);
		
		header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$params['promotors_id']."/promotion-actions/".$params['id']); 
	}

	public function generate()
	{	
		$packages = PromotionCodesPackage::where('generated<quantity', []);
		
		foreach ($packages as $package) {
			$i = 0;
			$number_codes_to_generate = $package->quantity - $package->generated;
			#echo "<pre>";
			#die(print_r($package->generated));
			while ($i < $number_codes_to_generate) { 
				#echo "<pre>";
				#die(print_r($package));
				$code_generator = new PromotionCodesGenerator;
				$code = $code_generator->promotion_code_generator(6);
				$promotion_code = new PromotionCode(['code'=>$code, 'package_id'=>$package->id]);
				
				if ($promotion_code->save() == true) {
					$i++;
					$package->generated++;
					$package->update(['generated'=>$package->generated]);
				}
			}
			#echo "<pre>";
			#die(print_r($i));
		}		
	}
}