<?php
/**
* 
*/
class PromotionCodesPackagesController extends Controller
{
	public $non_authorized = ['generate'];

	public function show()
	{
		$package = $this->package();
		$this->auth(__FUNCTION__, $package);

		if (!isset($_COOKIE['pri_promotor_show_package_view_notice'])) {
			setcookie('pri_promotor_show_package_view_notice', 'no', time() + (86400 * 30));
			$this->params['notice'] = 'yes';
		}

		$view = (new View($this->params, ['package'=>$package]))->render();
		return $view;
		
	}

	public function new()
	{
		$package = new CodesPackage;
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));	
		
		$view = (new View($this->params, ['package'=>$package]))->render();
		return $view;
	}

	public function create()
	{
		$this->auth(__FUNCTION__, Promotor::find($this->params['promotors_id']));	
		$this->params['promotion_codes_package']['action_id'] = $this->params['action_id'];
		$package = new CodesPackage($this->params['promotion_codes_package']);

		$router = Config::get('router');

		if ($package->save()) {

			$admin_order = new AdminOrder(['promotor_id'=>$this->params['promotors_id'],
										   'package_type' => 'action',
										   'package_id'=>$package->id,
										   'quantity'=>$package->quantity,
										   'order_date'=>$package->created_at]);

			$admin_order->save();
			
			(new AdminMailer)->newAdminOrder(Config::get('mailing_address'), $admin_order);

			$this->alert('info', 'Utworzono nową paczkę kodów');
			$path = $router->generate('show_promotion_codes_packages', ['promotors_id'=>$this->params['promotors_id'], 'action_id'=>$this->params['action_id'], 'id'=>$package->id]);
			header("Location: ".$path);
		}
		else{
			$this->alert('error', 'Paczka kodów nie została utworzona');
			$view = (new View($this->params, ['package'=>$package]))->render();
			return $view;
		} 		
	}

	public function edit()
	{
		$package = $this->package();
		$this->auth(__FUNCTION__, $package);
		
		$view = (new View($this->params, ['package'=>$package]))->render();
		return $view;
	}

	public function update()
	{
		$package = $this->package();
		$this->auth(__FUNCTION__, $package);

		$router = Config::get('router');

		if ($package->update($this->params['promotion_codes_package'])) {
		 	$this->alert('info', 'Edycja zakończona pomyślnie');
		 	$path = $router->generate('show_promotion_codes_packages', ['promotors_id'=>$this->params['promotors_id'], 'action_id'=>$this->params['action_id'], 'id'=>$this->params['id']]);
			header("Location: ".$path);
		} else {
			$this->alert('error', 'Edycja zakończona niepowodzeniem, spróbuj jeszcze raz');
			$view = (new View($this->params, ['package'=>$package]))->render();
			return $view;
		}
	}

	/* Funkcja generująca kody uruchamiana z url */
	public function generate()
	{	
		$packages = CodesPackage::where('`generated` < `quantity`', []);

		foreach ($packages as $package) {
			$i = 0;
			$number_codes_to_generate = $package->quantity - $package->generated;

			while ($i < $number_codes_to_generate) { 
				$code_generator = new PromotionCodesGenerator;
				$code = $code_generator->promotionCodeGenerator(6);
				$promotion_code = new Code(['code'=>$code, 'package_id'=>$package->id]);

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
		return CodesPackage::find($this->params['id']);
	}

	public function action()
	{
		return Action::find($this->params['action_id']);
	}
}