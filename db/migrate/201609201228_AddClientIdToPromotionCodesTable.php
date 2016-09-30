<?php
/**
* 
*/
class AddClientIdToPromotionCodesTable
{
	
	public function up(){
		$query = 'ALTER TABLE `promotion_codes` ADD 
				`client_id` integer';

		return $query;
	}

	public function down(){
		$query = 'ALTER TABLE `promotion_codes`
		DROP `client_id`';

		return $query;
	}
}