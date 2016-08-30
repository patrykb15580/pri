#!D:\xampp\php\php.exe -q
<?php

include 'core/FilesUntils.php';
include 'core/Tests.php';

if (isset($argv[1]) and (strpos($argv[1], 'db') !== false)) {
	$action = explode(':', $argv[1])[1];
	migrate();

}else test();

function migrate(){
	echo "Migracja";
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
        		 	echo '.';
       			 }
       			 catch(Exception $e){
       			 	echo $e -> getMessage();
       			 	die();
       			 }
        	}
		}
	}
}