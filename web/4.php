<?php
// Ejemplo ruta POST
// http://www.librosweb.es/silex/capitulo_2/enrutamiento.html


//ini_set('display_errors', 0); // No se si se debe poner
//error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['debug'] = true; // Mientras se programa
 
$app->post('/feedback', function (Request $request) {
//$app->match('/feedback', function (Request $request) {
  $message = $request->get('message');
  
  return  "<h1>Hola {$message}</h1>";
  //return new Response('Gracias por tus comentarios', 201);

  //mail('rafaelbascon@gmail.com', '[YourSite] Comentarios', $message);
  //return new Response('Gracias por tus comentarios', 201);

 });

 // Si queremos especificar el método en concreto:
 //->method('POST|GET');

$app->run();

?>
