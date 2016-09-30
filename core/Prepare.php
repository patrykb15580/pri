<?php
/**
* 
*/
class Prepare
{
	public static function prepare_db($db_name)
	{	
		$show_tables_query = 'SHOW TABLES FROM '.$db_name;
		$show_tables = mysqli_query(MyDB::db(), $show_tables_query);
		
		while ($row = mysqli_fetch_array($show_tables)) {
			if ($row[0] != 'schema_migrations') {
				$truncate_query = 'TRUNCATE TABLE `'.$row[0].'`';
				$truncate = mysqli_query(MyDB::db(), $truncate_query);
			}
		}		
	}
}