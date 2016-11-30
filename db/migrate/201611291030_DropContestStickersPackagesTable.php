<?php
/**
* 
*/
class DropContestStickersPackagesTable
{
	public function up(){
		$query = 'DROP TABLE `contest_stickers_packages`';

		return $query;
	}

	public function down(){
		$query = 'CREATE TABLE `contest_stickers_packages` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL,
		`contest_id` int(11) NOT NULL,
		`quantity` int(11) NOT NULL,
		 
		PRIMARY KEY (`id`) )';

		return $query;
	}
}