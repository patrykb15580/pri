<?php
/**
* 
*/
class AddHashColumnToClientsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `clients`
		ADD `hash` varchar(191) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_actions`
		DROP COLUMN `hash`';

		return $query;
	}
}