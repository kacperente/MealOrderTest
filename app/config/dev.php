<?php

require __DIR__ . '/common.php';

use \Silex\Provider\TwigServiceProvider;
use \Sorien\Provider\PimpleDumpProvider;
use \Silex\Provider\WebProfilerServiceProvider;

/** @var \Silex\Application $app */

// enable the debug mode
$app['debug'] = true;
$app['debug.html'] = true;

$app->register(new TwigServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasepath() . '/' . ltrim($asset, '/');
    }));
    return $twig;
});

$app->register(new PimpleDumpProvider());

$app->register(new WebProfilerServiceProvider(), [
    'profiler.cache_dir' => $app['path.cache_dir'] . '/profiler',
]);

$logger = getenv('DEBUG_SQL');
if ($logger) {
    $app['orm.em']
        ->getConnection()
        ->getConfiguration()
        ->setSQLLogger(new \Eden\MealOrder\Tools\SQLLogger($logger == 'logger' ? $app['logger'] : false));
}

unset($logger);
