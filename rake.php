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
		MigrationTools::clearTestDb();
		
		migrate();

		$compare = MigrationTools::compareDb();
		if (MigrationTools::compareDb() !== []) {
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
else if (isset($argv[1]) !== false) {
	$test_class = explode(':', $argv[1])[0]."Test";
	$test_method = 'test'.explode(':', $argv[1])[1];

	Config::set('env', 'test');

	$db_setup = 'db_'.Config::get('env');

	MyDB::connect(Config::get($db_setup));

	single_test($test_class, $test_method);
} 
else {


	Config::set('env', 'test');

	$db_setup = 'db_'.Config::get('env');

	MyDB::connect(Config::get($db_setup));

	test();
} 


function migrate(){

	MigrationTools::createSchemaTableMigration();

	foreach(glob('db/migrate/*', GLOB_BRACE) as $file){
    	
 	   	$file_name = pathinfo($file);
 	   	$explode_file_name = explode('_', $file_name['filename']);
 	   	$version = MigrationTools::getVersionFromFilename($explode_file_name);
    	$is_migrated = MigrationTools::isMigratedMigration($version);
    	if ($is_migrated == false) {
    		$class_name = MigrationTools::getClassnameFromFilename($explode_file_name);
    		include 'db/migrate/'.$file_name['filename'].'.php';
    		$query = (new $class_name) -> up();
    		
    		$migration = mysqli_query(MyDB::db(), $query);
    		if ($migration == false) {
    			die(CLIUntils::colorize("\nMigrate error: $file\n", 'FAILURE'));
    		}
    		else {
    			MigrationTools::incrementSchemaVersionIfSuccess($version);
    			print_r(CLIUntils::colorize("\nMigrate complete: ".$file_name['filename']."\n", 'SUCCESS'));
    		}
    	}

	}

}

function rollback(){
	
	$last_migration_version = mysqli_query(MyDB::db(), MigrationTools::selectLastMigration());
	$result_last_migration_version = mysqli_fetch_row($last_migration_version);
	if ($result_last_migration_version == false) {
		print_r(CLIUntils::colorize("\nTable empty\n", 'FAILURE'));
	}
	else{
		foreach(glob('db/migrate/*', GLOB_BRACE) as $file){   	
	 	   	$file_name = pathinfo($file);
	 	   	$explode_file_name = explode('_', $file_name['filename']);
	 	   	$version = MigrationTools::getVersionFromFilename($explode_file_name);
	    	if ($version == $result_last_migration_version[0]) {
	    		$class_name = MigrationTools::getClassnameFromFilename($explode_file_name);
	    		include 'db/migrate/'.$file_name['filename'].'.php';
	    		$drop_table = (new $class_name) -> down();

	    		$rollback = mysqli_query(MyDB::db(), $drop_table);
	    		if ($rollback == false) {
	    			die(CLIUntils::colorize("\nRollback error: $file\n", 'FAILURE'));
	    		}
	    		else {
	    			MigrationTools::deleteLastMigrationVersion($result_last_migration_version[0]);
	    			print_r(CLIUntils::colorize("\nRollback complete: ".$file_name['filename']."\n", 'SUCCESS'));
	    		}
	    	}

		}
	}	
}

function single_test($test_class, $test_method)
{
	$files_arr = FilesUntils::listFiles('spec');
	$test_files_paths = FilesUntils::filterTestFiles($files_arr, 'Test.php');

	foreach ($test_files_paths as $test_file_path) {
		$file_path = pathinfo($test_file_path);
		$class_name = $file_path['filename'];
		if ($class_name == $test_class) {
			include $test_file_path;
			$class = new $class_name;
			$class_info = new ReflectionClass($class);
			$methods = $class_info -> getMethods();
			foreach ($methods as $method) {
				$method_name = $method -> getName();
				if ($method_name == $test_method) {
					MyDB::clearDatabaseExceptSchema();
					try{
	        			$class -> $method_name();
	        			echo CLIUntils::colorize('Test Success', 'SUCCESS');
	       			}
	       			catch(Exception $e){
	       				echo CLIUntils::colorize("Test Failure", 'FAILURE');
	       				print_r($e -> getMessage()." ".$method_name);
	       			}
	        	}
			}
		}
	}
	MyDB::clearDatabaseExceptSchema();
}

function test(){
	$files_arr = FilesUntils::listFiles('spec');
	$test_files_paths = FilesUntils::filterTestFiles($files_arr, 'Test.php');
	$failure_arr = [];
	$succesed = 0;
	$tests_number = 0;
	foreach ($test_files_paths as $test_file_path) {
		include $test_file_path;
		$file_path = pathinfo($test_file_path);
		$class_name = $file_path['filename'];
		$class = new $class_name;
		$class_info = new ReflectionClass($class);
		$methods = $class_info -> getMethods();
		foreach ($methods as $method) {
			$method_name = $method -> getName();
			if (substr($method_name, 0, 4) == 'test') {
				MyDB::clearDatabaseExceptSchema();
				$tests_number++;
				try{
        			$class -> $method_name();
        			echo CLIUntils::colorize('.', 'SUCCESS');
        			$succesed++;
       			}
       			catch(Exception $e){
       			 	echo CLIUntils::colorize("F", 'FAILURE');
       			 	array_push($failure_arr, $e -> getMessage()." ".$method_name);
       			}
        	}
		}
	}
	if ($failure_arr == []) {
		print_r(CLIUntils::colorize("\nAll ".$tests_number." tests success\n", 'SUCCESS'));
	}
	else {
		print_r("\nTest errors:\n");
		foreach ($failure_arr as $error) {
			print_r(CLIUntils::colorize($error."\n\n", 'FAILURE'));
		}
		$failures = $tests_number-$succesed;
		print_r(CLIUntils::colorize('Tests succesed: '.$succesed.'/'.$tests_number."\nTests failure: ".$failures, 'FAILURE'));
	}
	MyDB::clearDatabaseExceptSchema();
}
