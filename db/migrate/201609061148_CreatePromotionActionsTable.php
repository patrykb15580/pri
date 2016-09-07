<?php
/**
* 
*/
class CreatePromotionActionsTable
{
	public function up(){
		$query = 'CREATE TABLE `promotion_actions` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		`name` varchar(191) NOT NULL,
		`promotors_id` int(11) NOT NULL,
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `promotion_actions`';

		return $query;
	}
}