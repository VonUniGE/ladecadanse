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
//    if (!$app['security.authorization_checker']->isGranted('edit', $organizer))
//        return;

    $events = $app['manager.event']->findAllByOrganizer($id);
    return $app['twig']->render('organizer.html.twig', ['organizer' => $organizer, 'events' => $events]);
})->bind('organizer');

// TODO: organizer form

$app->get('/places', function () use ($app) {
    $places = $app['manager.place']->findAll();
    
    return $app['twig']->render('places.html.twig', ['places' => $places]
    );
})->bind('places');

$app->get('/place/{id}', function ($id) use ($app) {
     
    $place = $app['manager.place']->find($id);
    if (!$app['security.authorization_checker']->isGranted('edit', $place))
        return;

    $events = []; //$app['manager.event']->findAllByPlace($id);
    return $app['twig']->render('place.html.twig', ['place' => $place, 'events' => $events]);
})->bind('place');

$app->match('/event/add', function (Request $request) use ($app) {
    $commentFormView = null;
    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
        // A user is fully authenticated : he can add comments
        $event = new Event();
        $user = $app['user'];
        $event->setAuthor($user);
        $commentForm = $app['form.factory']->create(LaDecadanse\Form\EventType::class, $event);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $app['manager.event']->save($event);
            $app['session']->getFlashBag()->add('success', 'Your event was successfully added.');
        }
        $commentFormView = $commentForm->createView();
    }
    //$comments = $app['manager.event']->findAllByArticle($id);

    return $app['twig']->render('event_form.html.twig', array(
        'commentForm' => $commentFormView));
})->bind('event_add');

//TODO:
//admin
//admin/organizers
//admin/events
//admin/users

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', ['error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        ]);
})->bind('login');

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
    'errors/'.$code.'.html.twig',
    'errors/'.substr($code, 0, 2).'x.html.twig',
    'errors/'.substr($code, 0, 1).'xx.html.twig',
    'errors/default.html.twig',
    );
    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});