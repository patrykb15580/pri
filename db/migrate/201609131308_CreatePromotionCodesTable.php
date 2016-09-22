<?php
/**
* 
*/
class CreatePromotionCodesTable
{
	
	public function up(){
		$query = 'CREATE TABLE `promotion_codes` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`code` varchar(191) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL,
		`package_id` int(11) NOT NULL,
		`used` datetime NOT NULL,
		 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `promotion_codes`';

		return $query;
	}
}