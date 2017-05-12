<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/assets/views',
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html');
});

$app->run();
