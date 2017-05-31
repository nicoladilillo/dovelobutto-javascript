<?php
  use Symfony\Component\HttpFoundation\Response;

  $app->get('/destroy', function () use ($app) {

    $app['session']->clear();
    return new Response('Change', 201);
  });
