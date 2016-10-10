<?php
include 'secret.php';

date_default_timezone_set('Europe/Warsaw');

Config::set('host', 'pri.dev');

Config::set('env', 'development');

Config::set('autoloader_paths', ['path1' => 'core/',
								 'path2' => 'config/',
								 'path3' => 'app/models/',
								 'path4' => 'app/controllers/',
								 'path5' => 'lib/',
								 'path6' => 'db/',
								 'path7' => 'app/classes/',
								 'path8' => 'app/helpers/',
								 'path9' => 'app/polices/',
								 'path10' => 'app/models/concerns/'
								]);

Config::set('mysqltime', 'Y-m-d H:i:s');

Config::set('salt', 'nfeifpwqjfewq');
