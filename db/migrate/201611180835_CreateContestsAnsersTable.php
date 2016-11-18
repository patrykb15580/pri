<?php
/**
* 
*/
class CreateContestsAnswersTable
{
	public function up(){
		$query = 'CREATE TABLE `contests_answers` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`contest_id` int(11) NOT NULL,
		`client_id` int(11) NOT NULL,
		`answer` text NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `contests_answers`';

		return $query;
	}
}