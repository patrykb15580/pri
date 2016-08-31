<?php
/**
* 
*/
class MigrationTools
{
	
	public static function create_schema_table_migration()
	{	
		$query = 'SELECT * FROM schema_migrations';
		$check = mysqli_query(MyDB::db(), $query);

		if ($check == null) {
			$query = "CREATE TABLE `schema_migrations` (`version` varchar(191) NOT NULL, UNIQUE KEY `unique_schema_migrations` (`version`))";
			$add_table = mysqli_query(MyDB::db(), $query);
		}
	}
	public static function get_version_from_filename($explode_file_name)
	{
		return $explode_file_name[0];
	}
	public static function get_classname_from_filename($explode_file_name)
	{	
		return $explode_file_name[1];
	}
	public static function is_migrated_migration($version)
	{
		$query = 'SELECT version FROM schema_migrations WHERE version = "'.$version.'"';
		$check = mysqli_query(MyDB::db(), $query);
		$result = mysqli_fetch_row($check);
		if ($result == NULL) {
			return false;
		}
		else{
			return true;
		}  
	}
	public static function increment_schema_version_if_success($version)
	{
		$query = 'INSERT INTO `schema_migrations`(`version`) VALUES ('.$version.')';
		$insert = mysqli_query(MyDB::db(), $query);
	}
}
