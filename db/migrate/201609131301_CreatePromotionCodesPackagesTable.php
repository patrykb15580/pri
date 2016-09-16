<?php
/**
* 
*/
class CreatePromotionCodesPackagesTable
{
	
	public function up(){
		$query = 'CREATE TABLE `promotion_codes_packages` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`name` varchar(191) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL,
		`action_id` int(11) NOT NULL,
		`reusable` boolean,
		`quantity` int(11) NOT NULL,
		`generated` int(11) NOT NULL,
		`status` varchar(191) NOT NULL,
		 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `promotion_codes_packages`';

		return $query;
	}
}