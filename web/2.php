<?php
// Ejemplo ruta GET
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
 
$app->get('/blog', function () use ($blogPosts) {
    $output = '';
    foreach ($blogPosts as $post) {
        $output .= $post['title'] . " " . $post['date'];
        $output .= '<br />';
    }
 
    return $output;
});

$app->run();

?>
