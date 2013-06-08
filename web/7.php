<?php

// Ejemplo 2.4.8. Valores por defecto
// http://www.librosweb.es/silex/capitulo_2/enrutamiento.html


ini_set('display_errors', 1); // Se debe poner
//error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['debug'] = true; // Mientras se programa

// http://localhost/pruebasilex2/web/7.php/blog_post
$app->get('/{pageName}', function ($pageName) {
 // ...
 return "<h1>Valor: $pageName</h1>"; 
})->bind('blog_post');

//->value('pageName', 'index');

$app->run();

 // Nº de fichero que se incluyen
 echo count(get_required_files()) ."<br>";
 print_r(get_required_files());

?>
