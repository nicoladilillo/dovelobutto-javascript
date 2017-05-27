<?php
  use Symfony\Component\HttpFoundation\Request;

  $app->get('/selectcity', function (Request $request) use ($app) {
    $city = strtolower($request->get('name'));
    $sql =
      "SELECT name AS name, ID AS id
       FROM cities
      WHERE name LIKE '$city%'";
    $row = $app['db']->fetchAll($sql);
    $app['session']->set('city',
      array(
        'name' => $row[0]['name'],
        'id' => $row[0]['id'],
      )
    );

    $output = [];
    foreach ($row as $row) {
      array_push($output,
        array(
          'id' => $row['id'],
          'name' => $row['name'],
        )
      );
    }

    return $app->json(array( 'data' => $output ), 201);
  });
