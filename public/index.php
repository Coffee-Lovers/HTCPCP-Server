<?php
require_once "../vendor/autoload.php";

$app = new Silex\Application();

// create a log channel
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stdout',
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

// create a rabbit service
$app['queue'] = function () use ($app) {
    return new \CLLibs\Queue\Queue\RabbitMQ(new \CLLibs\ConnectionConfig('rabbit', 5672, 'guest', 'guest'), $app['monolog']);
};

$app['hub'] = function () use ($app) {
    return new \CLLibs\Messaging\Hub\RabbitMQ(new \CLLibs\ConnectionConfig('rabbit', 5672, 'guest', 'guest'), $app['monolog']);
};

// admin controllers
$service = $app['controllers_factory'];

$service->match('/world', function () use ($app) {
    return (new CL\Controllers\HelloWorld($app['monolog']))->indexAction();
})->method('GET|BREW');
$app->mount("/hello", $service);

$app->match('/queue', function () use ($app) {
    return (new CL\Controllers\Queue($app['queue'], $app['hub'], $app['monolog'], $app['twig']))->pushAction();
})->method('POST|GET');

$app->run();
