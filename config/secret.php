<?php
$development = array();
$development['host'] = '127.0.0.1';
$development['user'] = 'pri_dev';
$development['password'] = 'qaz!@wsx';
$development['name'] = 'pri_dev';
Config::set('db_development', $development);

$test = array();
$test['host'] = '127.0.0.1';
$test['user'] = 'pri_test';
$test['password'] = 'qaz!@wsx';
$test['name'] = 'pri_test';
Config::set('db_test', $test);