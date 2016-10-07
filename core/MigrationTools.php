<?php
/**
* 
*/
class MigrationTools
{
	
	public static function createSchemaTableMigration()
	{	
		$query = 'SELECT * FROM schema_migrations';
		$check = mysqli_query(MyDB::db(), $query);

		if ($check == null) {
			$query = "CREATE TABLE `schema_migrations` (`version` varchar(191) NOT NULL, UNIQUE KEY `unique_schema_migrations` (`version`))";
			$add_table = mysqli_query(MyDB::db(), $query);
		}
	}
	public static function getVersionFromFilename($explode_file_name)
	{
		return $explode_file_name[0];
	}
	public static function getClassnameFromFilename($explode_file_name)
	{	
		return $explode_file_name[1];
	}
	public static function isMigratedMigration($version)
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

	public static function incrementSchemaVersionIfSuccess($version)
	{
		$query = 'INSERT INTO `schema_migrations`(`version`) VALUES ('.$version.')';
		$insert = mysqli_query(MyDB::db(), $query);
	}

	public static function selectLastMigration()
	{
		return 'SELECT `version` FROM `schema_migrations` ORDER BY `version` DESC LIMIT 1';
	}

	public static function deleteLastMigrationVersion($last_migration_version)
	{
		$query = 'DELETE FROM `schema_migrations` WHERE `version` = '.$last_migration_version;
		$delete = mysqli_query(MyDB::db(), $query);
	}

	public static function clearTestDb()
	{	
		$show_tables_query = 'SHOW TABLES FROM pri_test';
		$show_tables = mysqli_query(MyDB::db(), $show_tables_query);
		
		while ($row = mysqli_fetch_array($show_tables)) {

			if ($row[0] == 'schema_migrations') {
				$truncate_query = 'TRUNCATE TABLE `schema_migrations`';
				$truncate = mysqli_query(MyDB::db(), $truncate_query);
			}
			else {
				$drop_table_query = 'DROP TABLE '.$row[0];
				$drop_table = mysqli_query(MyDB::db(), $drop_table_query);
			}
		}
		
	}
	public static function compareDb()
	{
		$compare_errors = [];
		foreach(glob('db/migrate/*', GLOB_BRACE) as $file){
    		
	 	   	$file_name = pathinfo($file);
	 	   	$explode_file_name = explode('_', $file_name['filename']);
	 	   	$version = MigrationTools::getVersionFromFilename($explode_file_name);
	    	$is_migrated = MigrationTools::isMigratedMigration($version);
	    	if ($is_migrated == false) {;
	    		array_push($compare_errors, "Compare ".$file_name['filename'].": error \n");
	    	}
		}
		return $compare_errors;
	}
}


