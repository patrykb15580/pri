<?php
/**
* 
*/
class AddStatusColumnToPromotorTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotors`
		ADD `status` varchar(190) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotors`
		DROP COLUMN `status`';

		return $query;
	}
}