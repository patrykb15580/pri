<?php
/**
* 
*/
class CreateContestsTable
{
	public function up(){
		$query = 'CREATE TABLE `contests` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`name` varchar(191) NOT NULL,
		`question` text NOT NULL,
		`from_at` datetime NOT NULL, 
		`to_at` datetime NOT NULL, 
		`promotor_id` int(11) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		`status` varchar(191) NOT NULL,
		`type` boolean,
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `contests`';

		return $query;
	}
}