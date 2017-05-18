<?php

  $app->get('/search', function () use ($app) {
    $sql =
      "SELECT Name AS name FROM products";
    $post = $app['db']->fetchAssoc($sql);

    return $app->json($post, 201);
  });
