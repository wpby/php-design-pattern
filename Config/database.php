<?php
$config = array(
	'master' => [
		'type' => 'mysqli',
		'host' => 'localhost',
		'user' => 'homestead',
		'password' => 'secret',
		'dbname' => 'ysj',
	],
	'slave'=>[
		"slave1" => [
			'type' => 'mysqli',
			'host' => 'localhost',
			'user' => 'homestead',
			'password' => 'secret',
			'dbname' => 'ysj',
		],
	]
);

return $config;
