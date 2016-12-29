<?php
/**
* 
*/
class AllowNullForAnswerColumnInContestAnswersTable
{
	
	public function up(){
		$query = 'ALTER TABLE `contests_answers`
		MODIFY COLUMN `answer` text NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `contests_answers`
		MODIFY COLUMN `answer` text NOT NULL';

		return $query;
	}
}