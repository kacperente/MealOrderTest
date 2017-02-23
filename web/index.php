<?php

ini_set('display_errors', 0);

$_ENV['env'] = 'prod';

$app = require __DIR__ . '/../app/app.php';
$app->run();
