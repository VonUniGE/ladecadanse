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
//    role_hierarchy:
//        ROLE_MEMBER:      ROLE_USER
//        ROLE_ACTOR:      ROLE_MEMBER
//        ROLE_EDITOR:       ROLE_ACTOR
//        ROLE_ADMIN:       ROLE_EDITOR
//        ROLE_SUPER_ADMIN: [ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH]
//groupes :
//1	superadmin	accès à tout
//4	admin	utilisé ?
//6	auteur	accès à tous les contenus (11 pers.)
//8	acteur	ajout et modif de ses even, éventuellement de sa f...
//10	contributeur	? (33 personnes)
//12	membre	favoris, commentaires
$app->register(new Silex\Provider\SecurityServiceProvider(), [
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
    'security.role_hierarchy' => array(
        'ROLE_MEMBER' => ['ROLE_USER'],
        'ROLE_ACTOR' => ['ROLE_MEMBER'],
        'ROLE_EDITOR' => ['ROLE_ACTOR'],
        'ROLE_ADMIN' => ['ROLE_EDITOR'],
        'ROLE_SUPERADMIN' => ['ROLE_ADMIN', 'ROLE_ALLOWED_TO_SWITCH']        
    ),
    'security.access_rules' => [
        ['^/admin', 'ROLE_ADMIN']
       ]          
   ]);
  
$app['security.voters'] = $app->extend('security.voters', function ($voters, $app) {
    $voters[] = new \Ladecadanse\Voter\OrganizerVoter();
    $voters[] = new \Ladecadanse\Voter\PlaceVoter();

    return $voters;
});             
            
 
           
            
$app->register(new Silex\Provider\FormServiceProvider());            

// Register services.
$app['manager.user'] = function ($app) {
    return new Ladecadanse\Manager\UserManager($app['db']);
};            
            
$app['manager.organizer'] = function ($app) {
    $organizerManager = new Ladecadanse\Manager\OrganizerManager($app['db']);
    $organizerManager->setUserManager($app['manager.user']);
    return $organizerManager;
};

$app['manager.place'] = function ($app) {
    $placeManager = new Ladecadanse\Manager\PlaceManager($app['db']);
    $placeManager->setUserManager($app['manager.user']);
    $placeManager->setOrganizerManager($app['manager.organizer']);    
    return $placeManager;
};


$app['manager.event'] = function ($app) {
    $eventManager = new Ladecadanse\Manager\EventManager($app['db']);
    $eventManager->setUserManager($app['manager.user']);
    $eventManager->setOrganizerManager($app['manager.organizer']);
    return $eventManager;
};