<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Meetup;

use Meetup\Form\MeetupForm;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Meetup\Controller;
use Zend\ServiceManager\Factory\InvokableFactory;


return [
    'router' => [
        'routes' => [
            'meetups' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/meetups',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'detail' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/detail[/:id]',
                            'defaults' => [
                                'action'     => 'detail',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'add' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'update' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/update[/:id]',
                            'defaults' => [
                                'action'     => 'update',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/delete[/:id]',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ]
                        ],

                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
              Controller\IndexController::class => Controller\IndexControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            MeetupForm::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [

        'template_map' => [
            'meetup/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'meetup/index/add' => __DIR__ . '/../view/application/index/add.phtml',
            'meetup/index/update' => __DIR__ . '/../view/application/index/update.phtml',
            'meetup/index/detail' => __DIR__ . '/../view/application/index/detail.phtml',

        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'meetup_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Entity/',
                ],
            ],
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `application_driver` for any entity under namespace `Application\Entity`
                    'Meetup\Entity' => 'meetup_driver',
                ],
            ],
        ],
    ],
];
