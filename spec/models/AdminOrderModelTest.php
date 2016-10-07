<?php
/**
* 
*/
class AdminOrderModelTest extends Tests
{
	
	public function testAdminOrderIsValid()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'quantity'=>100, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> toEqual(true);
	}
	public function testPromotorIdShouldBeRequire()
	{
		$admin_order = new AdminOrder(['package_id'=>1, 'quantity'=>100, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> toEqual(false);
	}
	public function testPackageIdShouldBeRequire()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'quantity'=>100, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> toEqual(false);
	}
	public function testQuantityShouldBeRequire()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'reusable'=>0, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> toEqual(false);
	}
	public function testReusableShouldBeRequire()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'quantity'=>100, 'order_date'=>date(Config::get('mysqltime'))]);
		Assert::expect($admin_order -> isValid()) -> toEqual(false);
	}
	public function testOrderDateShouldBeRequire()
	{
		$admin_order = new AdminOrder(['promotor_id'=>1, 'package_id'=>1, 'quantity'=>100, 'reusable'=>0]);
		Assert::expect($admin_order -> isValid()) -> toEqual(false);
	}
}
