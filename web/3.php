<?php
// Ejemplo ruta DINAMICAS GET
// http://www.librosweb.es/silex/capitulo_2/enrutamiento.html

//ini_set('display_errors', 0); // No se si se debe poner

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true; // Mientras se programa

$blogPosts = array(
    1 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex',
        'body'      => '...',
    ),
);
 
$app->get('/blog/show/{id}', function (Silex\Application $app, $id) use ($blogPosts) {
    
    if (!isset($blogPosts[$id])){
        $app->abort(404, "El post $id no existe.");
    }

    $post = $blogPosts[$id];
 
    return  "<h1>{$post['title']}</h1>".
            "<p>{$post['body']}</p>";
    
 });

$app->run();

?>
