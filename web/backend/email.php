<?php
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;

  $app->post('/email', function (Request $request) use ($app) {
    $email = $request->get('email');
    $name = strtolower($request->get('name'));

    //Name product
    $sql = "SELECT ID as id FROM products WHERE name='$name'";
    $row = $app['db']->fetchAll($sql);
    if ( $row == [] ) {
      $app['db']->insert('products', array(
          'name' => $name,
        )
      );
      $name = (int)$app['db']->lastInsertId();
    }
    else
      $name = (int)$row[0]['id'];

    //Email
    $sql = "SELECT ID as id FROM emails WHERE email='$email'";
    $row = $app['db']->fetchAll($sql);
    if ( $row == [] ) {
      $app['db']->insert('emails', array(
          'email' => $email,
        )
      );
      $email = (int)$app['db']->lastInsertId();
    }
    else
      $email = (int)$row[0]['id'];

    //dump id
    $session = $app['session']->get('city');
    $dump = $session['dump'];

    $app['db']->insert('agreements', array(
        'id_product' => $name,
        'id_email' => $email,
        'id_status' => 2,
        'id_dump' => $dump,
      )
    );

    return new Response('Thank you for your help!', 201);
  });
