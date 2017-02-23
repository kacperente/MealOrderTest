<?php

ini_set('display_errors', 1);

$_ENV['env'] = 'dev';

$app = require __DIR__ . '/../app/app.php';
$app->run();
