<?php
/**
* 
*/
class AddDescriptionColumnToContestsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `contests`
		ADD `description` text NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `contests`
		DROP COLUMN `description`';

		return $query;
	}
}