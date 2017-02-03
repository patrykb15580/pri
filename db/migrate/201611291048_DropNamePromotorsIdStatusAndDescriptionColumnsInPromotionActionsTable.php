<?php
/**
* 
*/
class DropNamePromotorsIdStatusAndDescriptionColumnsInPromotionActionsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_actions`
		DROP `name`, DROP `promotors_id`, DROP `status`, DROP `description`';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_actions` ADD 
		(`name` varchar(191) NOT NULL,
		`promotors_id` int(11) NOT NULL,
		`status` varchar(191) NOT NULL,
		`description` text NULL)';

		return $query;
	}
}