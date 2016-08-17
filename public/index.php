<?php
require_once "../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$app = new Silex\Application();

// create a log channel
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stdout',
));

// create a rabbit service
$app['queue'] = function () {
    return new \CL\Queue\Implementations\RabbitMQ('rabbit', 5672, 'guest', 'guest');
};

// admin controllers
$service = $app['controllers_factory'];

$service->match('/world', function () use ($app) {
    return (new CL\Controllers\HelloWorld($app['monolog']))->indexAction();
})->method('GET|BREW');
$app->mount("/hello", $service);

$app->match('/queue', function () use ($app) {
    return (new CL\Controllers\Queue($app['queue'], $app['monolog']))->pushAction();
})->method('POST|GET');

$app->run();
