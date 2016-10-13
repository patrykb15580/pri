<?php
/**
* 
*/
class CreateOrdersTable
{
	
	public function up(){
		$query = 'CREATE TABLE `orders` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`promotor_id` int(11) NOT NULL, 
		`client_id` int(11) NOT NULL,
		`reward_id` int(11) NOT NULL,
		`order_date` datetime NOT NULL,
		`comment` text NULL, 
		`status` varchar(191) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `orders`';

		return $query;
	}
}