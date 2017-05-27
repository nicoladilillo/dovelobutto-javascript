<?php
  use Symfony\Component\HttpFoundation\Response;

  $app->post('/destroy', function () use ($app) {

    $app['session']->clear();
    return new Response('Change', 201);
  });
