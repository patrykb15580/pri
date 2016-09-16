<?php
/**
* 
*/
class AddStatusColumnToPromotionActionsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_actions`
		ADD `status` varchar(191) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_actions`
		DROP COLUMN `status`';

		return $query;
	}
}