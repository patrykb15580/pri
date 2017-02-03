<?php
/**
* 
*/
class AddDescriptionColumnToPromotionActionsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_actions`
		ADD `description` text NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_actions`
		DROP COLUMN `description`';

		return $query;
	}
}