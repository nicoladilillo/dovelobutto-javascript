<?php

  $app->get('/city', function () use ($app) {
    $city = $app['session']->get('city');

    return $app->json(array( 'data' => $city ), 201);
  });
