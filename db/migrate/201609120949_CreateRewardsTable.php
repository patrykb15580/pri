<?php
/**
* 
*/
class CreateRewardsTable
{
	public function up(){
		$query = 'CREATE TABLE `rewards` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(191) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		`status` varchar(191) NOT NULL,
		`description` text NOT NULL, 
		`prize` int(11) NOT NULL,
		`promotors_id` int(11) NOT NULL,
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `rewards`';

		return $query;
	}
}