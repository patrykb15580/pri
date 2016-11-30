<?php
/**
* 
*/
class DropNamePromotorIdStatusTypeAndDescriptionColumnsInContestsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `contests`
		DROP `name`, DROP `promotor_id`, DROP `status`, DROP `type`, DROP `description`';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `contests` ADD 
		(`name` varchar(191) NOT NULL,
		`promotor_id` int(11) NOT NULL,
		`status` varchar(191) NOT NULL,
		`description` text NULL,
		`type` boolean)';

		return $query;
	}
}