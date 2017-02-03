<?php
/**
* 
*/
class CreateRatesTable
{
	
	public function up(){
		$query = 'CREATE TABLE `rates` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`client_id` int(11) NOT NULL,
		`action_id` int(11) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		`rate` int(11) NULL,
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `rates`';

		return $query;
	}
}