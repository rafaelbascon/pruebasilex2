<?php

// Ejemplo 2.8. Forwards
// http://www.librosweb.es/silex/capitulo_2/forwards.html

ini_set('display_errors', 1); // Se debe poner
// error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

//use Silex\Application;


// Debemos declararlo para que no nos muestre el error:
// InvalidArgumentException: Identifier "url_generator" is not defined.
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// http://localhost/pruebasilex2/web/11.php/uno

$app->get('/uno', function () use ($app){
 // ...
 //$subRequest = Request::create('/dos', 'GET');
 $subRequest = Request::create($app['url_generator']->generate('nombreruta'), 'GET');

 // https://github.com/fabpot/Silex/issues/506
 // ERROR:
 // NotFoundHttpException: No route found for "GET /pruebasilex2/web/11.php/dos"
 // Nota.- Si se usan url amigables no sucede este error

 echo '<strong>SCRIPT_NAME</strong>' . '<br>';
 echo 'Valor 1: ' . $app['request']->server->get('SCRIPT_NAME') .'<br>';
 echo 'Valor 2: ' . $subRequest->server->get('SCRIPT_NAME') . '<br>';
 $subRequest->server->set('SCRIPT_NAME', $app['request']->server->get('SCRIPT_NAME')) . "<br>";
 echo 'Valor 2: ' . $subRequest->server->get('SCRIPT_NAME') . '<br>';
 echo '-----------------------------------------------------------------<br>';
 echo '<strong>SCRIPT_FILENAME</strong>' . '<br>';
 echo 'Valor 1: ' . $app['request']->server->get('SCRIPT_FILENAME') .'<br>';
 echo 'Valor 2: ' . $subRequest->server->get('SCRIPT_FILENAME') . '<br>';
 $subRequest->server->set('SCRIPT_FILENAME', $app['request']->server->get('SCRIPT_FILENAME'));
 echo 'Valor 2: ' . $subRequest->server->get('SCRIPT_FILENAME') . '<br>';
 echo '-----------------------------------------------------------------<br>';

 return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
 
 //return '<a href="'.$app['url_generator']->generate('nombreruta').'">Dos</a>';
 
});

$app->get('/dos', function () {
 return 'Correcto';
})->bind('nombreruta');

/*
$subRequest = Request::create($app['url_generator']->generate('blog'), 'POST');
$subRequest->server->set('SCRIPT_NAME', $app['request']->server->get('SCRIPT_NAME'));
$subRequest->server->set('SCRIPT_FILENAME', $app['request']->server->get('SCRIPT_FILENAME'));
return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
*/


// Otro ejemplo
/*
$app->get('/', function () {
    return 'Portada del sitio web';
})->bind('portada');
 
$app->get('/hola/{nombre}', function ($nombre) {
    return "Hola $nombre!";
})->bind('hola');
 
// http://localhost/pruebasilex2/web/11.php/menu
$app->get('/menu', function () use ($app) {
    return '<a href="'.$app['url_generator']->generate('portada').'">Inicio</a>'.
           ' | '.
           '<a href="'.$app['url_generator']->generate('hola', array('nombre' => 'Rafa')).'">Hola Rafa</a>';
});
*/

$app->run();


// Nº de fichero que se incluyen
/*
 echo "<h1>Ficheros cargados</h1>";
 echo count(get_required_files()) ."<br>";
 print_r(get_required_files());
*/

/*
Por Palma => En el index.php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

$app->get('/uno', function(Application $app) {
    $subRequest = Request::create($app['url_generator']->generate('nombreruta'), 'GET');
    return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
});

$app->get('/dos', function(){
    return "Correcto";
})->bind('nombreruta');
*/

?>


