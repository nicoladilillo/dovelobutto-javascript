<?php

  // web/index.php
  require_once __DIR__.'/../vendor/autoload.php';

  use Silex\Application;
  use Silex\Provider\TwigServiceProvider;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\ParameterBag;

  $app = new Application();

  $app->before(function (Request $request) {
      if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
          $data = json_decode($request->getContent(), true);
          $request->request->replace(is_array($data) ? $data : array());
      }
  });

  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
      'driver'    => 'pdo_mysql',
      'host'      => $url["host"],
      'dbname'    => substr($url["path"], 1),
      'user'      => $url["user"],
      'password'  => $url["pass"],
      'charset'   => 'utf8mb4'
    )
  ));

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
  ));

  $app->register(new Silex\Provider\SessionServiceProvider());

  $app->before(function ($request) {
    $request->getSession()->start();
  });

  $app->get('/', function () use ($app) {
    return $app['twig']->render('index.html');
  });

  require_once __DIR__.'/backend/search.php';
  require_once __DIR__.'/backend/email.php';
  require_once __DIR__.'/backend/city.php';
  require_once __DIR__.'/backend/selectcity.php';
  require_once __DIR__.'/backend/destroy.php';

  // set debug mode
  $app['debug'] = true;

  $app->run();
