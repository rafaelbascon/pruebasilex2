<?php

ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/prod.php';
require __DIR__.'/../src/controllers.php';

$app = new Silex\Application();

$app['debug']=true;

// http://localhost/pruebasilex2/web/index.php/
// http://localhost/pruebasilex2/web/
$app->get('/', function() use ($app){
	return "Hola mundo";
});

// http://localhost/pruebasilex2/web/index.php/hola/rafa
$app->get('/hola/{nombre}', function($nombre) use ($app){
	return "Hola ".$app->escape($nombre);
})->convert('nombre', function($n){ return strtoupper($n); });

//->assert('nombre', '\d+');

$app->get('/hola/din/amico', function() use ($app){
	return "<form method='post' action='/hola/din/amico'>".
		"<input name='nombre'>".
		"<input type='submit'>".
		"</form>";
});
$app->post('/hola/din/amico', function(Silex\Application $app) {
	$nombre=$app['request']->get('nombre');
	//return $nombre;
	return $app->redirect('/hola/'.$nombre);
});


$app->run();

?>
