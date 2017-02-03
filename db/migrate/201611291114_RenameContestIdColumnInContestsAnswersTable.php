<?php
/**
* 
*/
class RenameContestIdColumnInContestsAnswersTable
{
	
	public function up(){
		$query = 'ALTER TABLE `contests_answers`
		CHANGE `contest_id` `action_id` int(11) NOT NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `contests_answers`
		CHANGE `action_id` `contest_id` int(11) NOT NULL';

		return $query;
	}
}