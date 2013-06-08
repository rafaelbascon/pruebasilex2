<?php

// Ejemplo 2.6. Gestión de errores
// http://www.librosweb.es/silex/capitulo_2/gestion_de_errores.html

ini_set('display_errors', 1); // Se debe poner
// error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

// http://localhost/pruebasilex2/web/9.php/12
// Forzamos un error NO PASANDO PARAMETROS con: http://localhost/pruebasilex2/web/9.php/


$app->get('/{id}', function ($id) {
 // ...
 return "Valor: " . $id; 
});


// ->assert('id','\d+');
/*
TRUCO
Cuando la opción debug es true Silex utiliza un gestor de errores especial que muestra un montón de información 
sobre el error producido. Las funciones de tu aplicación encargadas de gestionar los errores siempre tienen 
preferencia sobre Silex, pero si quieres mantener la página de error con información detallada, utiliza un código 
como el siguiente:
*/

//$app['debug'] = true; // true, ¿Mientras se programa?


$app->error(function (\Exception $e, $code) use ($app) {
	 // gettype($e)
	 // Prevalece la gestión de errores de Silex si $app['debug'] = true
	 /*
	 if ($app['debug']){
	  return;
	 }
	 */
	 // Esta es nuestra gestión de errores propias
	 switch($code){
	   case 404:
			$mensaje = "<strong>Código: ". $code ."</strong> No se ha encontrado la página.";
			// Silex ignora el valor 404
			// return new Response('Error !!', 404, array('X-Status-Code' => 200));
			break;	
	   case 500:
			$mensaje = "Código: ". $code ." No se ha encontrado la página.";
			// Silex ignora el valor 404
			// return new Response('Error !!', 404, array('X-Status-Code' => 200));
			break;			
	   default:
			$mensaje = "Código de error: " . $code;
	 };

	   return new Response($mensaje);
	  
 });


/*
ERRORES CON abort()
Las funciones que manejan los errores también se ejecutan cuando se utiliza el método abort().
Para detener la ejecución de la aplicación:
*/
// http://localhost/pruebasilex2/web/9.php/blog/show/12

$blogPosts = array (1 => "Rafael", 2 =>"Juan", 3=>"");

$app->get('/blog/show/{id}', function (Silex\Application $app, $id) use ($blogPosts) {
    
    if (!isset($blogPosts[$id])) {
        echo "Entra<br>";
	    //$app->abort(404,'El post $id no existe.');
	    $app->abort(404); // Llama a $app->error()
    }   
  //  return new Response("Valor del post: " . $blogPosts[$id]);
  return "<h1>{$blogPosts[$id]}</h1>";
});


$app->run();


// Nº de fichero que se incluyen
 echo "<h1>Ficheros cargados</h1>";
 echo count(get_required_files()) ."<br>";
 print_r(get_required_files());

?>
