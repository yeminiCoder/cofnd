<?php

/**
 *  All errors handlers here
 */

// override handling exception for any exception in the app
/*$container['errorHandler'] = function ($container) {
  return new \Haidara\ErrorHandler\CustomHandler($container);
};*/

//Override the default Not Found Handler before creating App
$container['notFoundHandler'] = function ($container) {
  return function ($request, $response) use ($container) {
      return $response->withRedirect($container->router->pathFor('404'));
  };
};

//not allow exception
$container['notAllowedHandler'] = function ($container) {
  return function ($request, $response, $methods) use ($container) {
      return $response->withStatus(405)
          ->withHeader('Allow', implode(', ', $methods))
          ->withHeader('Content-type', 'text/html')
          ->write('Method must be one of: ' . implode(', ', $methods));
  };
};


//php running error handler
/*
$container['phpErrorHandler'] = function ($container) {
  return function ($request, $response, $error) use ($container) {
      return $response->withStatus(500)
          ->withHeader('Content-Type', 'text/html')
          ->write('Something went wrong!');
  };
};*/
