<?php
/**
* 
*/
class RenamePromotionCodesPackagesTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_codes_packages`
		RENAME TO `codes_packages`';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `codes_packages`
		RENAME TO `promotion_codes_packages`';

		return $query;
	}
}