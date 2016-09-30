<?php
/**
* 
*/
class AddTermColumnsToPromotionActionsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_actions` ADD 
				(`indefinitely` boolean, 
				`from_at` date NULL, 
				`to_at` date NULL)';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_actions`
		DROP `indefinitely`, DROP `from_at`, DROP `to_at`';

		return $query;
	}
}