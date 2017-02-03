<?php
/**
* 
*/
class CreateOpinionsTable
{
	public function up(){
		$query = 'CREATE TABLE `opinions` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`question` text NOT NULL,
		`action_id` int(11) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `opinions`';

		return $query;
	}
}