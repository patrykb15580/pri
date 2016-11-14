<?php
/**
* 
*/
class AddDescriptionColumnToPromotionActionsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_actions`
		ADD `description` varchar(191) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_actions`
		DROP COLUMN `description`';

		return $query;
	}
}