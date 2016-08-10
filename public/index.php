<?php
require_once "../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$app = new Silex\Application();

// create a log channel
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../app.log',
));

// admin controllers
$service = $app['controllers_factory'];
$service->get('/world', function () use ($app) {
    return (new CL\Controllers\HelloWorld($app['monolog']))->indexAction();
});

$app->mount("/hello", $service);
$app->run();
