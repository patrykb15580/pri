<?php
/**
* 
*/
class AddPackageTypeColumnAndRemoveReusableColumnInAdminOrdersTable
{
	
	public function up(){
		$query = 'ALTER TABLE `admin_orders`
		ADD `package_type` varchar(190) NOT NULL,
		DROP COLUMN `reusable`';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `admin_orders` 
		ADD `reusable` boolean NOT NULL, 
		DROP COLUMN `package_type`';

		return $query;
	}
}