<?php

return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host' => 'localhost',
					'port' => '3306',
					'user' => 'root',
					'password' => '',
					'dbname' => 'listonly',
					'driverOptions' => array(
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
					),
				),
			),
		),
	),
);

// php vendor/doctrine/doctrine-module/bin/doctrine-module