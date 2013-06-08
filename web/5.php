<?php
// Ejemplo VARIABLES en la RUTA
// http://www.librosweb.es/silex/capitulo_2/enrutamiento.html


//ini_set('display_errors', 0); // No se si se debe poner
//error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['debug'] = true; // Mientras se programa

// http://localhost/pruebasilex2/web/5.php/blog/show/12/13 
// $app->get('/blog/show/{id1}/{id2}', function (Silex\Application $app, Request $request,$id1,$id2){    
$app->get('/blog/show/{id1}/{id2}', function (Request $request, $id1, $id2){ 

  return  "<h1>Valores del Request: <br>{$request} <br><br> Valores pasados en url: id1 = {$id1} id2 = {$id2}</h1>";

 });

 $app->run();

?>
