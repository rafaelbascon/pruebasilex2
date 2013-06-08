<?php

// Ejemplo 2.7. Redirecciones
// http://www.librosweb.es/silex/capitulo_2/redirecciones.html

ini_set('display_errors', 1); // Se debe poner
// error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

// http://localhost/pruebasilex2/web/10.php/12

$app->get('/{id}', function ($id) use ($app) {
 // ...
 //return $app->redirect('/hello');
 //return $app->redirect('http://www.elmundo.es');
 return $app->redirect('/1.htm'); // Responde: http://localhost/1.htm

});


$app->run();


// Nº de fichero que se incluyen
 echo "<h1>Ficheros cargados</h1>";
 echo count(get_required_files()) ."<br>";
 print_r(get_required_files());

?>
