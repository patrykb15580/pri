<?php
/**
* 
*/
class FilesUntils{

    public static function listFiles($dir){
        $allfiles = [];
        $ffs = scandir($dir);
        foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){   
            if(is_dir($dir.'/'.$ff)){
                $files = FilesUntils::listFiles($dir.'/'.$ff);
                $allfiles = array_merge($files, $allfiles);
            }
            else{
                $allfiles[] = $dir.'/'.$ff;
            }
        }
    }
    return $allfiles;
    }

    public static function filterTestFiles(array $files_arr, string $match){
    $test_files_arr = [];
    foreach ($files_arr as $file) {
        if (strpos($file, $match) !== false) {
            $test_files_arr[] = $file;
        }
    }
    return $test_files_arr; 
    }
}