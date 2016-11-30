<?php
/**
* 
*/
class AddActionIdColumnInPromotionActionsTable
{
	public function up(){
		$query = 'ALTER TABLE `promotion_actions` ADD 
		`action_id` int(11) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_actions`
		DROP `action_id`';

		return $query;
	}
}