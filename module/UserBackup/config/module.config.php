<?php

namespace User;

return array(
    'router' => array(
        'routes' => array(
            'user-register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action'     => 'register',
                    ),
                ),
            ),
            
            /*
            'user-listagem' => array(
                'type' => 'regex',
                'options' => array(
                    'route' => '/users/(?P<id>\d+)',
                    'spec' => '/users/%id%',
                    'defaults' => array(
                        'controller' => '',
                        'action' => '',
                    ),
                ),
            ),
             */
            
            /*
            'wildcard' => array(
                'type' => 'wildcard',
                'options' => array(
                    'key_value_delimiter' => '/',
                    'param_delimiter' => '/',
                ),
            ),
            */
            
            /*'artigos' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/artigos',
                    'default' => array(
                        'controller' => '1',
                        'action' => '1',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'detalhe' => array(
                            'type' => 'segment',
                            'route' => '/:id',
                            'constraints' => array(
                                'id' => '\d+',
                            ),
                            'default' => array(
                                'action' => '2',
                            ),
                        ),
                    ),
                ),
            ),
            // <?=$this->url('artigos/detalhes', array('id' => 1))? >
            */

            'user-activate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    /*
                    'constraints' => array(
                        'key' => '\d+',
                    ),
                    'route' => '/users[/page-:pageNo]',
                      //=> /users ou /users/page-1
                    'route' => '/artigo/:id{-}-:slug', => /artigo
                      //=> /artigo/431-meu-nome-e-son ou /artigo/431/xyv/isso-e-legal
                    'route' => '/eventos/:evento{0-9}::year',
                      //=> /eventos/son2012 ou /eventos/eve2010
                     */
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action' => 'activate',
                    ),
                ),
            ),
            'user-auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Auth',
                        'action' => 'index',
                    ),
                ),
            ),
            'user-logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout',
                    ),
                ),
            ),
            'user-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/users',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Users',
                        'action' => 'Index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'User\Controller',
                                'controller' => 'users',
                            ),
                        ),
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/page/:page]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'User\Controller',
                                'Controller' => 'users',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController',
            'User\Controller\Users' => 'User\Controller\UsersController',
            'User\Controller\Auth' => 'User\Controller\AuthController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__. '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
    'data-fixture' => array(
        'User_fixture' => __DIR__ . '/../src/User/Fixture',
    ),
);
