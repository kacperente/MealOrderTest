<?php

use Eden\CommunicationStandards\Message\Success;

/** @var \Silex\Application $app */
$app->register(new \Silex\Provider\ServiceControllerServiceProvider());

// example

$app['app.demo_controller'] =
    function () use ($app) {
        return new \Eden\MealOrder\Controller\DemoController(
            $app['orm.em']->getConnection()
        );
    }
;


/**
 * Put all routes below
 */
$app->get('/status', function() { return new \Eden\CommunicationStandards\Message\Success(); });
$app->get('/demo/{valueToGet}', 'app.demo_controller:getSomething');
$app->get('/menu/{restaurant}','app.demo_controller:getUserFromDb');
$app->get('/menu','app.demo_controller:getAllMenus');
$app->post('/demo', 'app.demo_controller:createSomething');
