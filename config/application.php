<?php

date_default_timezone_set('Europe/Warsaw');

Config::set('host', 'pri.dev');

Config::set('env', 'development');

Config::set('autoloader_paths', ['1' => 'core/',
								 '2' => 'config/',
								 '3' => 'app/models/',
								 '4' => 'app/controllers/',
								 '5' => 'lib/',
								 '6' => 'db/',
								 '7' => 'app/classes/',
								 '8' => 'app/helpers/',
								 '9' => 'app/polices/',
								 '10' => 'app/models/concerns/',
								 '11' => 'app/mailer/'
								]);

Config::set('mysqltime', 'Y-m-d H:i:s');

Config::set('salt', 'nfeifpwqjfewq');

include 'secret.php';