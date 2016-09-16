<?php
/**
* 
*/
class AddCodesIndexToPromotionCodesTable
{
	
	public function up(){
		$query = 'CREATE INDEX codes
		ON promotion_codes (code)';

		return $query;
	}

	public function down(){
		$query = 'DROP INDEX codes
		ON promotion_codes';

		return $query;
	}
}