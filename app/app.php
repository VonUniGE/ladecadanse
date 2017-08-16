<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1'
));

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => function () use ($app) {
                return new Ladecadanse\Manager\UserManager($app['db']);
            },
        ),
    ),
));

// Register services.
$app['manager.user'] = function ($app) {
    return new Ladecadanse\Manager\UserManager($app['db']);
};            
            
$app['manager.organizer'] = function ($app) {
    return new Ladecadanse\Manager\OrganizerManager($app['db']);
};

$app['manager.event'] = function ($app) {
    $eventManager = new Ladecadanse\Manager\EventManager($app['db']);
    //$eventManager->setOrganizerManager($app['manager.organizer']);
    return $eventManager;
};