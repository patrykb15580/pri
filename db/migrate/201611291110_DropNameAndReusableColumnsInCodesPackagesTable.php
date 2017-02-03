<?php
/**
* 
*/
class DropNameAndReusableColumnsInCodesPackagesTable
{
	
	public function up(){
		$query = 'ALTER TABLE `codes_packages`
		DROP `name`, DROP `reusable`';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `codes_packages` ADD 
		(`name` varchar(191) NOT NULL,
		`reusable` boolean)';

		return $query;
	}
}