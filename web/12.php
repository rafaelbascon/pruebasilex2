<?php

// Ejemplo: 2.9. JSON
// http://www.librosweb.es/silex/capitulo_2/json.html

ini_set('display_errors', 1); // Se debe poner
// error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

$app = new Silex\Application();

$app['debug'] = true;
// http://localhost/pruebasilex2/web/12.php/usuarios/22

$app->get('/usuarios/{id}', function ($id) use ($app) {
    
    //$user = getUser($id);
    $user = array( 'nombre' => 'Rafael' , 'apellidos' => 'Bascón', 'edad' => '44');

    if (!$user) {
        $error = array('message' => 'No se ha encontrado al usuario.');
        return $app->json($error, 404);
    }
 
    return $app->json($user);
    echo "<br>";
});


$app->run();


// Nº de fichero que se incluyen
 
 //echo "<h1>Ficheros cargados</h1>";
 //echo count(get_required_files()) ."<br>";
 print_r(get_required_files());

?>
