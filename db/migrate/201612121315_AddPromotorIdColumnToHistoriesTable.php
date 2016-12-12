<?php
/**
* 
*/
class AddPromotorIdColumnToHistoriesTable
{
	
	public function up(){
		$query = 'ALTER TABLE `histories`
		ADD `promotor_id` int(11) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `histories`
		DROP COLUMN `promotor_id`';

		return $query;
	}
}