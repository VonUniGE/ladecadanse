<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/', function () use ($app) {
    
    return $app['twig']->render('index.html.twig', []);
})->bind('home');

$app->get('/organizers', function () use ($app) {
    $organizers = $app['manager.organizer']->findAll();
    
    return $app['twig']->render('organizers.html.twig', 
 ['organizers' => $organizers]
    );
})->bind('organizers');

$app->get('/organizer/{id}', function ($id) use ($app) {
    $organizer = $app['manager.organizer']->find($id);
    
    $events = $app['manager.event']->findAllByOrganizer($id);
    return $app['twig']->render('organizer.html.twig', ['organizer' => $organizer, 'events' => $events]);
})->bind('organizer');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', ['error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        ]);
})->bind('login');