<?php
/**
* 
*/
class CreateActionsTable
{
	public function up(){
		$query = 'CREATE TABLE `actions` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(191) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		`status` varchar(191) NOT NULL,
		`description` text NULL, 
		`promotor_id` int(11) NOT NULL,
		`type` varchar(191) NOT NULL,
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `actions`';

		return $query;
	}
}