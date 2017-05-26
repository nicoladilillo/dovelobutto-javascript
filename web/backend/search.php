<?php
  use Symfony\Component\HttpFoundation\Request;

  $app->get('/search', function (Request $request) use ($app) {
    $name = strtolower($request->get('name'));
    $sql =
      "SELECT b.Name as bin, b.ID as id, p.Name AS name
       FROM (agreements a INNER JOIN products p ON (a.id_product=p.ID))
            INNER JOIN bins b ON (a.id_bin=b.ID)
      WHERE p.Name LIKE '$name%' and a.id_status=1";
    $row = $app['db']->fetchAll($sql);

    $output = [];
    if ( $row == [] or $row[0]['name'] != $name ) {
      array_push($output,
        array(
          'name' => $name,
          'bin' => null
        )
      );
    };

    foreach ($row as $row) {
      array_push($output,
        array(
          'bin' => array(
            'id' => $row['id'],
            'name' => $row['bin']
          ),
          'name' => $row['name'],
        )
      );
    }

    return $app->json(array( 'data' => $output ), 201);
  });
