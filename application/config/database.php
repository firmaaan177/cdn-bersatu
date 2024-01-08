<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'u1576371_cdnbersatudev',
	'password' => 'db]cRg8yOiq[',
	'database' => 'u1576371_cdnbersatu-dev',
	// 'hostname' => '45.87.80.154',
	// 'username' => 'u705868495_agara',
	// 'password' => '5q?G?NScnq4K',
	// 'database' => 'u705868495_agara',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
