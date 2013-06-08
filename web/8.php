<?php

// Ejemplo 2.4.10. Controladores como métodos de clases
// http://www.librosweb.es/silex/capitulo_2/enrutamiento.html

ini_set('display_errors', 1); // Se debe poner
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$app['debug'] = true; // Mientras se programa

// Ejemplo: Configuración Global
// http://www.librosweb.es/silex/capitulo_2/configuracion_global.html
$app['controllers']
    ->assert('miparametro', '\d+')
    ->value('miparametro', '1');


/* 
No definimos el controlador como función anónima, si no como un METODO de una CLASE
$app->get('/{pageName}', function ($pageName) {
 // ...
 return " "; 
});
*/

// Incluimos la clase con la declaración del namespace "MisPaquetes"
// require_once __DIR__.'/MiClase.php';
// Para no realizar lo anterior, podemos usar el fichero composer.json especificando el valor:
//  "autoload": {
//        "psr-0": { "MisPaquetes": "src/" }
// 
// A nivel de carpetas tendríamos:
// /src/MisPaquetes/MiClase.php

// IMPORTANTE: El fichero composer.json NO se tiene encuenta hasta que no se ejecuta: $app->run();
// por lo que cualquier llamada a la clase del namespace antes de esa instrucción no es posible

// http://localhost/pruebasilex2/web/8.php/RAFAEL
$app->get('/{miparametro}', 'MisPaquetes\MiClase::mimetodoControlador');

/*******
$app->get('/{miparametro}', 'MiClase::mimetodoControlador');
class MiClase
    {
        public function mimetodoControlador(Request $request){
	   return "<h2>Valores pasado en url: miparametro = {$request->attributes->get('miparametro')}</h2>";
        }
    }
*******/

// LLamamos a una función usando Namespace. Declarada en MiClase.php
// Nos da un error: Fatal error: Call to undefined function MisPaquetes\saludo() 
// si se usa la declaración del namespace con el fichero composer.json ya que no ha podido "Ejecutar" todo el
// código del fichero php que tiene el namespace

// MisPaquetes\saludo();

$app->run();

// LLamamos a una CONSTANTE usando Namespace. Declarada en MiClase.php
// echo MisPaquetes\MICONSTANTE;

// Otro controlador:
// Definimos el controlador como función anónima.
// http://localhost/pruebasilex2/web/8.php/

$app->get('/', function() {
 // ...
 return "Es otro controlador"; 
});





// Nº de fichero que se incluyen
 echo "<br>" . count(get_required_files()) ."<br>";
 print_r(get_required_files());

?>
