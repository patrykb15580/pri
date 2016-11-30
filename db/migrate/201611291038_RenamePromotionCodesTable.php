<?php
/**
* 
*/
class RenamePromotionCodesTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_codes`
		RENAME TO `codes`';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `codes`
		RENAME TO `promotion_codes`';

		return $query;
	}
}