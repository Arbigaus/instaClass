<?php
require 'environment.php';

// TODO: Definição da global BASE
$url = "http://".$_SERVER['HTTP_HOST'];
define("BASE", $url);

$admin_url = $url."/admin";
define("BASEADMIN", $admin_url);

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
