<?php
/**
* 
*/
class CreatePointsBalancesTable
{
	
	public function up(){
		$query = 'CREATE TABLE `points_balances` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`client_id` int(11) NOT NULL, 
		`promotor_id` int(11) NOT NULL, 
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL,
		`balance` int(11) NOT NULL,  
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `points_balances`';

		return $query;
	}
}