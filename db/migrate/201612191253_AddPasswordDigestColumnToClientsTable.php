<?php
/**
* 
*/
class AddPasswordDigestColumnToClientsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `clients`
		ADD `password_digest` varchar(191) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `clients`
		DROP COLUMN `password_digest`';

		return $query;
	}
}