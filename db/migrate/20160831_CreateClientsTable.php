<?php
/**
* 
*/
class CreateClientsTable
{
	
	public function up(){
		$query = 'CREATE TABLE `clients` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`email` varchar(191) NOT NULL, 
		`password_digest` varchar(191) NOT NULL, 
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		`name` varchar(191) NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `clients`';
	}
}