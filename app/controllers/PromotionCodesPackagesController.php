<?php
/**
* 
*/
class PromotionCodesPackagesController extends Controller
{
	public $non_authorized = ['generate'];

	public function show()
	{
		$this->auth(__FUNCTION__, $this->package());	
		$package = PromotionCodesPackage::find($this->params['id']);

		(new View($this->params, ['package'=>$package]))->render();
		
	}

	public function new()
	{
		$this->auth(__FUNCTION__, $this->promotionAction());	
		$package = new PromotionCodesPackage;
		(new View($this->params, ['package'=>$package]))->render();
	}

	public function create()
	{
		$this->auth(__FUNCTION__, $this->promotionAction());	
		$this->params['promotion_codes_package']['action_id'] = $this->params['action_id'];
		$package = new PromotionCodesPackage($this->params['promotion_codes_package']);

		if ($package->save()) {

			$admin_order = new AdminOrder(['promotor_id'=>$this->params['promotors_id'],
										   'package_id'=>$package->id,
										   'quantity'=>$package->quantity,
										   'reusable'=>$package->reusable,
										   'order_date'=>$package->created_at]);

			$admin_order->save();
			header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/promotion-actions/".$this->params['action_id']);
		}
		else{
			(new View($this->params, ['package'=>$package]))->render();
		} 		
	}

	public function edit()
	{
		$this->auth(__FUNCTION__, $this->package());	
		$package = new PromotionCodesPackage;
		$package = PromotionCodesPackage::find($this->params['action_id']);
		(new View($this->params, ['package'=>$package]))->render();
	}

	public function update()
	{
		$this->auth(__FUNCTION__, $this->package());	
		$package = PromotionCodesPackage::findBy('id', $this->params['id']);
		$package->update($this->params['promotion_codes_package']);
		
		header("Location: http://".$_SERVER['HTTP_HOST']."/promotors/".$this->params['promotors_id']."/promotion-actions/".$this->params['action_id']."/package/".$this->params['id']); 
	}

	/* Funkcja uruchomiona po z url */
	public function generate()
	{	
		$packages = PromotionCodesPackage::where('`generated` < `quantity`', []);

		foreach ($packages as $package) {
			$i = 0;
			$number_codes_to_generate = $package->quantity - $package->generated;

			while ($i < $number_codes_to_generate) { 

				$code_generator = new PromotionCodesGenerator;
				$code = $code_generator->promotionCodeGenerator(6);
				$promotion_code = new PromotionCode(['code'=>$code, 'package_id'=>$package->id]);

				if ($promotion_code->save()) {
					$i++;
					$package->generated++;
					$package->save();
				}
			}
		}		
	}

	public function package()
	{
		return PromotionCodesPackage::find($this->params['id']);
	}
}