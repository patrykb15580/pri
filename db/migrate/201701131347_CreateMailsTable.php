<?php
/**
* 
*/
class CreateMailsTable
{
	
	public function up(){
		$query = 'CREATE TABLE `mails` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`promotor_id` int(11) NOT NULL,
		`subject` varchar(191) NOT NULL,
		`recipients` text NOT NULL,
		`content` text NOT NULL,
		`mailed` datetime NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL, 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `mails`';

		return $query;
	}
}