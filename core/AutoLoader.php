<?php
$extensions = array('.php','.class.php','.interface.php');
$ext = implode(',',$extensions);
spl_autoload_register(null, false);
spl_autoload_extensions($ext);
 
function classLoader($classname){
    $extensions = array('.php','.class.php','.interface.php');
    if (class_exists($classname, false)){ return; }
    $class = explode('_', strtolower(strval($classname)));
    $deeps = count($class);
    $file = $DOCUMENT_ROOT;
    for ($i=0;$i<$deeps;$i++){
        $file .= '/'.$class[$i];
    }
    foreach ($extensions as $ext){
        $fileClass = $file.$ext;
        if (file_exists($fileClass) && is_readable($fileClass) && !class_exists($classname, false)){
            require_once($fileClass);
            return true;
        }
    }
    return false;
}
spl_autoload_register('classLoader');
/* kod funckji interfaceLoader */
spl_autoload_register('interfaceLoader');