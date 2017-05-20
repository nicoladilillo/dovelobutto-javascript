<?php

  // web/index.php
  require_once __DIR__.'/../vendor/autoload.php';

  use Silex\Application;
  use Silex\Provider\TwigServiceProvider;

  $app = new Application();

  $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
      'driver'    => 'pdo_mysql',
      'host'      => 'localhost',
      'dbname'    => 'dovelobutto',
      'user'      => 'vagrant',
      'password'  => 'vagrant',
      'charset'   => 'utf8mb4'
    )
  ));

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
  ));

  $app->get('/', function () use ($app) {
    return $app['twig']->render('index.html');
  });

  require_once __DIR__.'/backend/search.php';

  // set debug mode
  $app['debug'] = true;

  $app->run();
