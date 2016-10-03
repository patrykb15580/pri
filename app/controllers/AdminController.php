<?php
/**
* 
*/
class AdminController
{
	public function show($params)
	{
		$promotors = Promotor::all([]);
		
		$view = (new View($params, ['promotors'=>$promotors]))->render();
	}

	public function new_promotor($params)
	{
		$promotor = new Promotor;

		$view = (new View($params, ['promotor'=>$promotor]))->render();
	}

	public function create_promotor($params)
	{	
		$password = $params['promotor']['password_degest'];
		$confirm_password = $params['confirm_password'];
		$equal = Password::equalPasswords($password, $confirm_password);
		$promotor = new Promotor($params['promotor']);
		
		if ($equal == true) {
			if ($promotor->save()) {
			$promotor->update(['password_degest'=>Password::encryptPassword($password)]);
			header("Location: http://".$_SERVER['HTTP_HOST']."/admin?promotor=confirm");
			} else {
				$promotor = new Promotor($params['promotor']);
				$view = (new View($params, ['promotor'=>$promotor]))->render();
			}
		} else {
			$promotor = new Promotor($params['promotor']);
			$view = (new View($params, ['promotor'=>$promotor]))->render();
		}
	}

	public function edit_promotor($params)
	{
		$promotor = new Promotor;
		$promotor = Promotor::find($params['promotors_id']);
		$view = (new View($params, ['promotor'=>$promotor]))->render();
	}

	public function update_promotor($params)
	{
		$promotor = Promotor::find($params['promotors_id']);
		
		$old_password = Password::encryptPassword($params['old_password']);
		$new_password = Password::encryptPassword($params['promotor']['password_degest']);
		$params['promotor']['password_degest'] = Password::encryptPassword($params['promotor']['password_degest']);

		if (Password::equalPasswords($old_password, $new_password) == true) {
			if (Promotor::update_promotor($params)) {
				header("Location: http://".$_SERVER['HTTP_HOST']."/admin");
			} else header("Location: http://".$_SERVER['HTTP_HOST']."/admin/edit-promotor//".$params['promotors_id']);
		} else header("Location: http://".$_SERVER['HTTP_HOST']."/admin/edit-promotor/".$params['promotors_id']);
	}
	public function index_orders($params)
	{
		
	}
}