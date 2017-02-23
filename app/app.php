<?php

date_default_timezone_set('UTC');

$loader = require __DIR__ . '/../vendor/autoload.php';
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$app = new \Silex\Application();
$app['path.root_dir'] = dirname(__DIR__);

// setting envs
putenv('CACHE_DIR=' . $app['path.root_dir'] . '/app/cache');
putenv('LOG_DIR=' . $app['path.root_dir'] . '/app/logs/');
putenv('LOG_FILENAME=app.log');
putenv('LOG_DOMAIN=backend');
putenv('LOG_SUBSYSTEM=intern');
putenv('LOG_APP=intern');
putenv('LOG_APP_ID=1');

putenv('DATABASE__DRIVER=pdo_mysql');
putenv('DATABASE__HOST=localhost');
putenv('DATABASE__DBNAME=mos');
putenv('DATABASE__USERNAME=kacper');
putenv('DATABASE__PASSWORD=kacper93');

$app['path.cache_dir'] = getenv('CACHE_DIR');
$app['path.config_dir'] = "{$app['path.root_dir']}/app/config";
$app['path.log_dir'] = getenv('LOG_DIR');
$app['path.log_filename'] = getenv('LOG_FILENAME');
$app['log.name'] = 'mealOrder';
$app['log.domain'] = getenv('LOG_DOMAIN');
$app['log.subsystem'] = getenv('LOG_SUBSYSTEM');
$app['log.app'] = getenv('LOG_APP');
$app['log.appType'] = getenv('LOG_APP_TYPE');
$app['log.appId'] = getenv('LOG_APP_ID');

// optional:
//$app->register(new \Silex\Provider\UrlGeneratorServiceProvider);
//$app->register(new \Silex\Provider\ServiceControllerServiceProvider());
//$app->register(new \Silex\Provider\HttpFragmentServiceProvider());


require $app['path.config_dir'] . '/' . $_ENV['env'] . '.php';
require $app['path.root_dir'] . '/app/routing.php';


return $app;
