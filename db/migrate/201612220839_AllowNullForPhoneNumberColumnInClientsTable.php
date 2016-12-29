<?php
/**
* 
*/
class AllowNullForPhoneNumberColumnInClientsTable
{
	
	public function up(){
		$query = 'ALTER TABLE `clients`
		MODIFY COLUMN `phone_number` varchar(191) NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `clients`
		MODIFY COLUMN `phone_number` varchar(191) NOT NULL';

		return $query;
	}
}