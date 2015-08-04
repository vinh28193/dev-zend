<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'training' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/training',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Training\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'         => '[0-9]'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Training\Controller',
                                'controller'    => 'Index',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'list' =>array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/list',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Training\Controller',
                                'controller'    => 'Index',
                                'action'        => 'list',
                            ),
                        ),
                    ),
                    'add' =>array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/add',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Training\Controller',
                                'controller'    => 'Index',
                                'action'        => 'add',
                            ),
                        ),
                    ),
                    'edit' =>array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/edit/:id',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Training\Controller',
                                'controller'    => 'Index',
                                'action'        => 'edit',
                                'id'            => '[0-9]'
                            ),
                        ),
                    ),
                    'delete' =>array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/delete/:id',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Training\Controller',
                                'controller'    => 'Index',
                                'action'        => 'delete',
                                'id'            => '[0-9]'
                            ),
                        ),
                    ),

                ),
            ),
        ),
    ),
    'db' => array(
        'driver' => 'Pdo',
        'dsn'            => 'mysql:dbname=dev-zf2;hostname=localhost',
        'username'       => 'root',
        'password'       => '',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Training\Controller\Index' => 'Training\Controller\IndexController',

        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'             => __DIR__ . '/../view/layout/layout.phtml',
            'training/index/index'      => __DIR__ . '/../view/training/index/index.phtml',
            'training/index/list'       => __DIR__ . '/../view/training/index/list.phtml',
            'training/index/add'        => __DIR__ . '/../view/training/index/add.phtml',
            'training/index/edit'       => __DIR__ . '/../view/training/index/edit.phtml',
            'training/index/delete'     => __DIR__ . '/../view/training/index/delete.phtml',
            'paginator/paginator'       => __DIR__ . '/../view/paginator/paginator.phtml',
            'error/404'                 => __DIR__ . '/../view/error/404.phtml',
            'error/index'               => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
