<?php
return array(
    'modules' => array(
        'Application',
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
        //'Acl',
        'Base',
        //'User',
        // teste

        'Alternative',
        'Answer',
        'Evaluation',
        'Form',
        'Question',
        'Title',
        'User',
    ),

    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),

        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    ),
);
