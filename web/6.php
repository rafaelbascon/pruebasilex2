<?php

// Ejemplo Modificando las variables de la ruta
// http://www.librosweb.es/silex/capitulo_2/enrutamiento.html


ini_set('display_errors', 1); // Se debe poner
//error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['debug'] = true; // Mientras se programa

// http://localhost/pruebasilex2/web/6.php/blog/show/12/13 
// $app->get('/blog/show/{id1}/{id2}', function (Silex\Application $app, Request $request,$id1,$id2){    

/***
$app->get('/blog/show/{id1}/{id2}', function (Request $request, $id1, $id2){ 

  return  "<h1>Valores del Request: <br>{$request} <br><br> Valores pasado en url: id1 = {$id1} 
           <br>Valor modificado antes de pasar al controlador: id2 = {$id2}</h1>";

 })->convert('id2',function ($id2){
  	 return($id2*2);
 });
 ***/

class_exists('Usuario.class.php') || require_once __DIR__.'/Usuario.class.php';
//require_once(Usuario.class.php);

 /*
 class Usuario{
    var $datos = "Rafael Bascón Barrera";

    function Usuario($id){
      echo $id . " " . $this->datos;
    }
    function mostrar($id){
      echo "<br>" . $id . " " . $this->datos;
    }
 }
 */
 
 $userProvider = function ($id) {
    return new Usuario($id);
 };
 // http://localhost/pruebasilex2/web/6.php/user/100
 /****
 $app->get('/user/{miuser}', function () {
    // ...
    $id = 500;
    echo '<br>';
    $miObjeto = new  Usuario($id);
    return '';
   
 })->convert('miuser', $userProvider);
 ****/

/***
 // Otra forma
 // http://localhost/pruebasilex2/web/6.php/user/100
 $app->get('/user/{miuser}', function (Usuario $miuser) {
    // ...
    $id = 500;
    echo '<br>';
    return "{$miuser->Usuario($id)}";

 })->convert('miuser', $userProvider);

 $app->run();
***/

/*** 
 $callback = function ($id, Request $request) {
    echo $id . " = " . $request->attributes->get('miuser') . "<br>";
    
    return new Usuario($request->attributes->get('otrovalor'));
 
 };

// http://localhost/pruebasilex2/web/6.php/user/100/1000
$app->get('/user/{miuser}/{otrovalor}', function (Usuario $miuser) {
    // ...
    return '';
})->convert('miuser', $callback);

$app->run();
***/

 $callback = function ($id,Request $request) {
    echo $request->attributes->get('miuser') . "<br>";
    echo $request->attributes->get('otrovalor') . "<br>";
    
    return new Usuario($request->attributes->get('otrovalor'));
 };

// http://localhost/pruebasilex2/web/6.php/user/100/1000
$app->get('/user/{miuser}/{otrovalor}', function () {
    // ...
    return '';
})->convert('miuser',$callback)
->assert('miuser', '\d+');

/* Con expresiones regulares podemos especificar de qué tipo debe ser el valor pasado */
/* \d+ => Entero Positivo */

$app->run();




 // Nº de fichero que se incluyen
 echo "<br>";
 echo count(get_required_files()) ."<br>";
 print_r(get_required_files());

?>
