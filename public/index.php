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
$app['queue'] = function () {
    return new \CLLibs\Queue\Implementations\RabbitMQ('rabbit', 5672, 'guest', 'guest');
};

// admin controllers
$service = $app['controllers_factory'];

$service->match('/world', function () use ($app) {
    return (new CL\Controllers\HelloWorld($app['monolog']))->indexAction();
})->method('GET|BREW');
$app->mount("/hello", $service);

$app->match('/queue', function () use ($app) {
    return (new CL\Controllers\Queue($app['queue'], $app['monolog'], $app['twig']))->pushAction();
})->method('POST|GET');

$app->run();
