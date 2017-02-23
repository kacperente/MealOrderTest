<?php


$app->register(new \Silex\Provider\SerializerServiceProvider());

/** @var \Silex\Application $app */
$app->register(new \Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'   => getenv('DATABASE__DRIVER'),
        'host'     => getenv('DATABASE__HOST'),
        'dbname'   => getenv('DATABASE__DBNAME'),
        'user'     => getenv('DATABASE__USERNAME'),
        'password' => getenv('DATABASE__PASSWORD'),
    ],
]);

$app->register(new \Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider, [
    'orm.proxies_dir' => $app['path.cache_dir'] . '/proxies',
    'orm.em.options' => [
        'mappings' => [
            [
                'type' => 'annotation',
                'namespace' => 'Eden\MealOrder\Entity',
                'path' => $app['path.root_dir'] . '/src/Entity',
                'use_simple_annotation_reader' => false,
            ],
        ],
    ],
]);

$app->register(new \Silex\Provider\MonologServiceProvider(), [
    'monolog.logfile' => $app['path.log_dir'] . '/' . $app['path.log_filename'],
    'monolog.level' => 'debug',
    'monolog.name' => 'mealOrder',
]);
$app->register(new \LD\PHPLogger\LogFormatterServiceProvider(), [
    'monolog.logfile.ld' => getenv('LOG_DIR').getenv('LOG_FILENAME'),
    'monolog.level.ld'   => 'debug',
]);

$app->register(new \LD\RequestTracking\Silex\RequestTrackingServiceProvider(), [
    'ld_request_tracking.header_name' => 'X-REQUEST-TOKEN',
    'ld_request_tracking.propagator_service' => new \LD\RequestTracking\RequestToken\Propagator\NullPropagator(),
    'ld_request_tracking.logger.request_token' => 'request_token',
    'ld_request_tracking.logger.min_level' => 100,
]);
$app->register(new \LD\SymfonyListeners\SilexProvider\Listener\ResponseSentTimerListenerProvider());
$app->register(new \LD\SilexMiddlewares\Providers\EdenMiddlewareProvider());

//$app->register(new \Eden\MealOrder\ServicesProviders\DemoUsersFinderProvider());


/*
 * Put middleware's at the end
 */
//$app->register(new \LD\SilexMiddlewares\EdenMiddlewareProvider());
// Put JSON data in Request's ParameterBag
//$app->before(
//    [\LD\SilexMiddlewares\RequestDecoding::class, 'injectJsonContentIntoRequest']
//);
//
//// Enable request tracking
//$app->before(
//    [\LD\SilexMiddlewares\RequestTracking::class, 'detectRequestUid'],
//    \Silex\Application::LATE_EVENT
//);
//
//$app->after(
//    [\LD\SilexMiddlewares\RequestTracking::class, 'addRequestUidToResponse']
//);


/*
 * Error handling
 */
$app->error(function (\Exception $e, $code) {
    return new \Symfony\Component\HttpFoundation\Response('Found error: ' . $e->getMessage());
});

/*
 * Events
 */
$app->on(Symfony\Component\HttpKernel\KernelEvents::TERMINATE, $app['listener.response_sent_timer'], \Silex\Application::EARLY_EVENT);