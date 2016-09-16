<?php
/**
* 
*/
class CreateImagesTable
{
	
	public function up(){
		$query = 'CREATE TABLE `images` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`file_name` varchar(191) NOT NULL,
		`size` int(11) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL,
		`reward_id` int(11) NOT NULL, 
		 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `images`';

		return $query;
	}
}