#!D:\xampp\php\php.exe -q
<?php

include 'core/Config.php';
include 'config/application.php';
include 'core/AutoLoader.php';


if (isset($argv[1]) and (strpos($argv[1], 'db') !== false)) {
	$action = explode(':', $argv[1])[1];
	if ($action == 'test_migrate') {
		Config::set('env', 'test');

		$db_setup = 'db_'.Config::get('env');
		
		MyDB::connect(Config::get($db_setup));
		MigrationTools::clear_test_db();
		
		migrate();

		$compare = MigrationTools::compare_db();
		if (MigrationTools::compare_db() !== []) {
			print_r("\nCompare databases errors:\n");
			foreach ($compare as $compare_error) {
				print_r(CLIUntils::colorize($compare_error."\n", 'FAILURE'));
			};
		}
		else print_r(CLIUntils::colorize("\nCompare Databases: OK", 'SUCCESS'));
	}
	else if ($action == 'seed') {
		$db_setup = 'db_'.Config::get('env');
		
		MyDB::connect(Config::get($db_setup));

		include 'db/Seed.php';
	}
	else if ($action != '') {
		$db_setup = 'db_'.Config::get('env');
		
		MyDB::connect(Config::get($db_setup));

		$action();
	}
	else print_r(CLIUntils::colorize("\nError: function not found\n", 'FAILURE'));
	

}
else{

	Config::set('env', 'test');

	$db_setup = 'db_'.Config::get('env');

	MyDB::connect(Config::get($db_setup));

	test();
} 


function migrate(){

	MigrationTools::create_schema_table_migration();

	foreach(glob('db/migrate/*', GLOB_BRACE) as $file){
    	
 	   	$file_name = pathinfo($file);
 	   	$explode_file_name = explode('_', $file_name['filename']);
 	   	$version = MigrationTools::get_version_from_filename($explode_file_name);
    	$is_migrated = MigrationTools::is_migrated_migration($version);
    	if ($is_migrated == false) {
    		$class_name = MigrationTools::get_classname_from_filename($explode_file_name);
    		include 'db/migrate/'.$file_name['filename'].'.php';
    		$query = (new $class_name) -> up();
    		
    		$migration = mysqli_query(MyDB::db(), $query);
    		if ($migration == false) {
    			die(CLIUntils::colorize("\nMigrate error: $file\n", 'FAILURE'));
    		}
    		else {
    			MigrationTools::increment_schema_version_if_success($version);
    			print_r(CLIUntils::colorize("\nMigrate complete: ".$file_name['filename']."\n", 'SUCCESS'));
    		}
    	}

	}

}

function rollback(){
	
	$last_migration_version = mysqli_query(MyDB::db(), MigrationTools::select_last_migration());
	$result_last_migration_version = mysqli_fetch_row($last_migration_version);
	if ($result_last_migration_version == false) {
		print_r(CLIUntils::colorize("\nTable empty\n", 'FAILURE'));
	}
	else{
		foreach(glob('db/migrate/*', GLOB_BRACE) as $file){   	
	 	   	$file_name = pathinfo($file);
	 	   	$explode_file_name = explode('_', $file_name['filename']);
	 	   	$version = MigrationTools::get_version_from_filename($explode_file_name);
	    	if ($version == $result_last_migration_version[0]) {
	    		$class_name = MigrationTools::get_classname_from_filename($explode_file_name);
	    		include 'db/migrate/'.$file_name['filename'].'.php';
	    		$drop_table = (new $class_name) -> down();

	    		$rollback = mysqli_query(MyDB::db(), $drop_table);
	    		if ($rollback == false) {
	    			die(CLIUntils::colorize("\nRollback error: $file\n", 'FAILURE'));
	    		}
	    		else {
	    			MigrationTools::delete_last_migration_version($result_last_migration_version[0]);
	    			print_r(CLIUntils::colorize("\nRollback complete: ".$file_name['filename']."\n", 'SUCCESS'));
	    		}
	    	}

		}
	}	
}

function test(){
	$files_arr = FilesUntils::list_files('spec');
	$test_files_paths = FilesUntils::filter_test_files($files_arr, 'Test.php');
	$failure_arr = [];
	foreach ($test_files_paths as $test_file_path) {
		include $test_file_path;
		$file_path = pathinfo($test_file_path);
		$class_name = $file_path['filename'];
		$class = new $class_name;
		$class_info = new ReflectionClass($class);
		$methods = $class_info -> getMethods();
		foreach ($methods as $method) {
			$method_name = $method -> getName();
			if (substr($method_name, 0, 5) == 'test_') {
				MyDB::clear_database_except_schema();
				 try{
        			$class -> $method_name();
        			echo CLIUntils::colorize('.', 'SUCCESS');
       			 }
       			 catch(Exception $e){
       			 	echo CLIUntils::colorize("F", 'FAILURE');
       			 	array_push($failure_arr, $e -> getMessage()." ".$method_name);
       			 }
        	}
		}
	}
	if ($failure_arr == []) {
		print_r(CLIUntils::colorize("\nAll tests success\n", 'SUCCESS'));
	}
	else {
		print_r("\nTest errors:\n");
		foreach ($failure_arr as $error) {
			print_r(CLIUntils::colorize($error."\n\n", 'FAILURE'));
		}
	}
	MyDB::clear_database_except_schema();
}
