<?php

use Symfony\Component\HttpFoundation\Request;
use Ladecadanse\Entity\Event;
use Ladecadanse\Entity\Organizer;
use Ladecadanse\Form\EventType;
use Ladecadanse\Form\OrganizerType;

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
    //dump($events);
    return $app['twig']->render('organizer.html.twig', ['organizer' => $organizer, 'events' => $events]);
})->bind('organizer');

$app->match('/organizers/add', function (Request $request) use ($app) {
    
    $organizerFormView = null;
    
    if ($app['security.authorization_checker']->isGranted('ROLE_ADMIN')) {

        // par défaut
        $organizer = new Organizer([]);
        $organizer->setAuthor($app['user']);
        $organizer->setStatus('actif');         
        
        $organizerForm = $app['form.factory']->create(OrganizerType::class, $organizer);
        $organizerForm->handleRequest($request);
        if ($organizerForm->isSubmitted() && $organizerForm->isValid()) {
           
            
            $app['manager.organizer']->save($organizer);
            $app['session']->getFlashBag()->add('success', 'The organizer was successfully added.');
        }
        $organizerFormView = $organizerForm->createView();
    }

    return $app['twig']->render('organizer_form.html.twig', array(
        'title' => 'Add organizer',
        'organizerForm' => $organizerFormView));
})->bind('organizer_add');

$app->match('/organizer/{id}/edit', function($id, Request $request) use ($app) {
    
    $organizerFormView = null;
    $organizer = $app['manager.organizer']->find($id);  
    
    if ($app['security.authorization_checker']->isGranted('edit', $organizer))
    {    
        $options['user_roles'] = [
            'ROLE_EDITOR' => $app['security.authorization_checker']->isGranted('ROLE_EDITOR'), 
            'ROLE_ADMIN' => $app['security.authorization_checker']->isGranted('ROLE_ADMIN')
            ];         

        $organizerForm = $app['form.factory']->create(OrganizerType::class, $organizer, $options);
        $organizerForm->handleRequest($request);

        if ($organizerForm->isSubmitted() && $organizerForm->isValid()) {             
            $app['manager.organizer']->save($organizer);
            $app['session']->getFlashBag()->add('success', 'The organizer was successfully updated.');
        }

        $organizerFormView = $organizerForm->createView();
    }
    
    return $app['twig']->render('organizer_form.html.twig', array(
        'title' => 'Edit organizer',
        'organizerForm' => $organizerFormView));
})->bind('organizer_edit');

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
    $eventFormView = null;
    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {

        // par défaut
        $event = new Event([]);
        $event->setAuthor($app['user']);
        $event->setStatus('actif');
        
        // all active places, Place 
        $options['places'] = $app['manager.place']->findAll();
        $options['towns'] = $app['manager.town']->findAll();
        
        //dump($options['towns']);
        $eventForm = $app['form.factory']->create(EventType::class, $event, $options);
        $eventForm->handleRequest($request);
        if ($eventForm->isSubmitted() && $eventForm->isValid()) {
           
            if (!empty($event->getTownId()))
            {
                $eventTown = $app['manager.town']->find($event->getTownId());      
                
                $event->setTownName($eventTown['name']);
                $event->setTownRegion($eventTown['region']);
            }
            
            $app['manager.event']->save($event);
            $app['session']->getFlashBag()->add('success', 'Your event was successfully added.');
        }
        $eventFormView = $eventForm->createView();
    }
    //$comments = $app['manager.event']->findAllByArticle($id);

    return $app['twig']->render('event_form.html.twig', array(
        'title' => 'Add event',
        'eventForm' => $eventFormView));
})->bind('event_add');


// Edit an existing article
$app->match('/event/{id}/edit', function($id, Request $request) use ($app) {
    
    $event = $app['manager.event']->find($id);
        $options['places'] = $app['manager.place']->findAll();
        $options['towns'] = $app['manager.town']->findAll();    
    
    $eventForm = $app['form.factory']->create(EventType::class, $event, $options);
    $eventForm->handleRequest($request);
    
    if ($eventForm->isSubmitted() && $eventForm->isValid()) {
        
        if (!empty($event->getTownId()))
        {
            $eventTown = $app['manager.town']->find($event->getTownId());      

            $event->setTownName($eventTown['name']);
            $event->setTownRegion($eventTown['region']);
        }        
        $app['manager.event']->save($event);
        $app['session']->getFlashBag()->add('success', 'The event was successfully updated.');
    }
    
    return $app['twig']->render('event_form.html.twig', array(
        'title' => 'Edit event',
        'eventForm' => $eventForm->createView()));
})->bind('event_edit');

$app->get('/user/{id}', function ($id) use ($app) {
     
    $user = $app['manager.user']->find($id);
    if (!$app['security.authorization_checker']->isGranted('edit', $user))
        return;

    return $app['twig']->render('user.html.twig', ['user' => $user]);
})->bind('user');


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