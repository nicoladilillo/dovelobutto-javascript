<?php
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;

  $app->get('/searchcity', function (Request $request) use ($app) {
    $city = strtolower($request->get('name'));
    $sql =
      "SELECT c.name AS city, c.id AS id, d.id AS dump
      FROM cities c INNER JOIN  dumps d ON (c.dump_id=d.id)
      WHERE c.name LIKE '$city%'";
    $row = $app['db']->fetchAll($sql);

    $output = [];
    if ( $row == [] or $row[0]['city'] != $city ) {
      array_push($output,
        array(
          'name' => $city,
          'id' => null,
        )
      );
    };

    foreach ($row as $row) {
      array_push($output,
        array(
          'id' => $row['id'],
          'name' => $row['city'],
          'dump' => $row['dump'],
        )
      );
    }

    return $app->json(array( 'data' => $output ), 201);
  });

  $app->post('/selectcity', function (Request $request) use ($app) {
    $city = $request->get('name');
    $id = $request->get('city');
    $dump = $request->get('dump');
    $app['session']->set('city',
      array(
        'name' => $city,
        'id' => $id,
        'dump' => $dump,
      )
    );

    return new Response('Thank you for your help!', 201);
  });
