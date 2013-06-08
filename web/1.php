<?php

//ini_set('display_errors', 0); // No se si se debe poner

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true; // Mientras se programa

http://localhost/pruebasilex2/web/1.php/hola
$app->get('/hola',function(){

	return 'Hola a todos. © RjBB';

});

$app->run();


?>
