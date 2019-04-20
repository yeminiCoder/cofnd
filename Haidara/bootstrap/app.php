<?php

require_once __DIR__.'/../vendor/autoload.php';

//Start app here
$app = new \Slim\App(
    [
      'settings' =>[

          'determineRouteBeforeAppMiddleware' => true,
          'displayErrorDetails'=>true,
          'addContentLengthHeader' => false,

            'db'=>[
                  'driver'    =>'mysql',
                  'host'      =>'localhost',
                  'database'  =>'corfriend',
                  'username'  =>'root',
                  'password'  =>'',
                  'charset'   =>'utf8',
                  'collation' =>'utf8_unicode_ci',

                'prefix'    =>'',
                'options' => [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => true,
                     ],
                  ]
         ],

]);

// Get container
$container = $app->getContainer();

$capsule= new \Illuminate\Database\Capsule\Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function () use($capsule) { return $capsule; };

require_once('handler.php');

//require controllers
require_once('control.php');


// routes
 require_once __DIR__ . '/../haidaracademy/routes.php';
session_start();

?>