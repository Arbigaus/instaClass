<?php
require 'environment.php';

define("BASE", "http://sistema.pc");
define("BASEADMIN", "http://sistema.pc/admin");

global $config;
$config = array();
if(ENVIRONMENT == "development") {
	$config['dbname'] = 'mvc';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'projetos';
	$config['dbpass'] = 'g123456@*';
} else {
	$config['dbname'] = 'mvc';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'projetos';
	$config['dbpass'] = 'g123456@*';
}