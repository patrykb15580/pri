<?php
/**
* 
*/
class CreatePromotorsAvatarsTable
{
	
	public function up(){
		$query = 'CREATE TABLE `promotors_avatars` ( 
		`id` int(11) NOT NULL AUTO_INCREMENT, 
		`file_name` varchar(191) NOT NULL,
		`size` int(11) NOT NULL,
		`created_at` datetime NOT NULL, 
		`updated_at` datetime NOT NULL,
		`promotor_id` int(11) NOT NULL, 
		 
		PRIMARY KEY (`id`) )';

		return $query;
	}

	public function down(){
		$query = 'DROP TABLE `promotors_avatars`';

		return $query;
	}
}