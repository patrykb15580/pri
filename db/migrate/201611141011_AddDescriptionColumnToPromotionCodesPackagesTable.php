<?php
/**
* 
*/
class AddDescriptionColumnToPromotionCodesPackagesTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_codes_packages`
		ADD `description` text NULL';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_codes_packages`
		DROP COLUMN `description`';

		return $query;
	}
}