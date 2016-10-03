<?php
/**
* 
*/
class CreateAdminOrdersTable
{
	public function up(){
		$query = 'CREATE TABLE `admin_orders` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`promotor_id` int(11) NOT NULL,
		`package_id` int(11) NOT NULL,
		`quantity` int(11) NOT NULL,
		`reusable` boolean NOT NULL,
		`order_date` datetime NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		`status` varchar(190) NOT NULL,
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `admin_orders`';

		return $query;
	}
}