<?php
/**
* 
*/
class CreateTokensTable
{
	public function up(){
		$query = 'CREATE TABLE `tokens` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`client_id` int(11) NOT NULL,
		`token` varchar(191) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `tokens`';

		return $query;
	}
}