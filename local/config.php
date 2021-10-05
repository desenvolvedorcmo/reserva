<?php
defined('BASEPATH') OR exit('No direct script access allowed');

return array(

	'config' => array(
		'base_url' => 'http://localhost/reserva/',
		'log_threshold' => 1,
		'index_page' => 'index.php',
		'uri_protocol' => 'REQUEST_URI',
	),

	'database' => array(
		'dsn' => '',
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => '123',
		'database' => 'reserva',
		'dbdriver' => 'pdo',
		'subdriver' => 'mysql',
	),

);
