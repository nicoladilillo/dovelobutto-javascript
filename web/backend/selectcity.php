<?php
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;

  $app->get('/searchcity', function (Request $request) use ($app) {
    $city = strtolower($request->get('name'));
    $sql =
      "SELECT name AS name, ID AS id
       FROM cities
      WHERE name LIKE '$city%'";
    $row = $app['db']->fetchAll($sql);

    $output = [];
    if ( $row == [] or $row[0]['name'] != $city ) {
      array_push($output,
        array(
          'name' => $city,
          'id' => null
        )
      );
    };

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

  $app->post('/selectcity', function (Request $request) use ($app) {
    $city = $request->get('name');
    $id = $request->get('id');  
    $app['session']->set('city',
      array(
        'name' => $city,
        'id' => $id,
      )
    );

    return new Response('Thank you for your help!', 201);
  });
