<?php
/**
* 
*/
class AdminOrderModelTest extends Tests
{
	
	public function test_admin_order_is_valid()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'quantity'=>100, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> to_equal(true);
	}
	public function test_promotor_id_should_be_require()
	{
		$admin_order = new AdminOrder(['package_id'=>1, 'quantity'=>100, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> to_equal(false);
	}
	public function test_package_id_should_be_require()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'quantity'=>100, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> to_equal(false);
	}
	public function test_quantity_should_be_require()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> to_equal(false);
	}
	public function test_reusable_should_be_require()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'quantity'=>100, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> to_equal(false);
	}
	public function test_order_date_should_be_require()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'quantity'=>100, 'reusable'=>0]);
		Assert::expect($admin_order -> isValid()) -> to_equal(false);
	}
}
