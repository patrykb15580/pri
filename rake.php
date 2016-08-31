#!D:\xampp\php\php.exe -q
<?php

include 'core/FilesUntils.php';
include 'core/Tests.php';
include 'core/CLIUntils.php';
include 'config/application.php';
include 'core/MyDB.php';
include 'core/MigrationTools.php';


if (isset($argv[1]) and (strpos($argv[1], 'db') !== false)) {
	$action = explode(':', $argv[1])[1];
	if ($action == 'test_migrate') {
		Config::set('env', 'test');

		$db_setup = 'db_'.Config::get('env');
		
		MyDB::connect(Config::get($db_setup));

		migrate();
	}
	else if ($action == 'migrate') {
		$db_setup = 'db_'.Config::get('env');
		
		MyDB::connect(Config::get($db_setup));

		migrate();
	}
	else echo "Error";
	

}else test();


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
    			die(CLIUntils::colorize("\nMigrate error: $file\n\n", 'FAILURE'));
    		}
    		else MigrationTools::increment_schema_version_if_success($version);
    	}
	}

}

function rollback(){
	
}

function test(){
	$files_arr = FilesUntils::list_files('spec');
	$test_files_paths = FilesUntils::filter_test_files($files_arr, 'Test.php');

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
				 try{
        			$class -> $method_name();
        			echo CLIUntils::colorize('.', 'SUCCESS');
       			 }
       			 catch(Exception $e){
       			 	echo CLIUntils::colorize($e -> getMessage(), 'FAILURE');
       			 	die();
       			 }
        	}
		}
	}
}