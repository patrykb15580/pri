<?php
/**
* 
*/
class CreateHistoriesTable
{
	
	public function up(){
		$query = 'CREATE TABLE `histories` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`client_id` int(11) NOT NULL, 
		`points` varchar(190) NOT NULL, 
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL,
		`balance_before` int(11) NOT NULL, 
		`balance_after` int(11) NOT NULL, 
		`description` text NOT NULL,  
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `histories`';

		return $query;
	}
}