<?php
/**
* 
*/
class AddActionIdColumnInContestsTable
{
	public function up(){
		$query = 'ALTER TABLE `contests` ADD 
		`action_id` int(11) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `contests`
		DROP `action_id`';

		return $query;
	}
}