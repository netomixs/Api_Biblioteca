<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\LibroController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {

    return "Hola mundo";
});
//Autor
$router->get("/autor","AutorController@getAll");
$router->get("/autor/persona","AutorController@getAllWithPerson");
$router->get("/autor/{id}","AutorController@get");
$router->get("/autor/{id}/libro","AutorController@getLibros");
$router->get("/autor/{id}/persona","AutorController@getWithPerson");
$router->post("/autor","AutorController@insert");
$router->post("/autor/{id}","AutorController@update");
$router->delete("/autor/{id}","AutorController@delete");
//Rutas de persona
$router->get("/persona","PersonaController@getAll");
$router->get("/persona/{id}","PersonaController@get");
$router->post("/persona","PersonaController@insert");
$router->post("/persona/{id}","PersonaController@update");
$router->delete("/persona/{id}","PersonaController@delete");
//Nivel
$router->get("/nivel","NivelController@getAll");
$router->get("/nivel","NivelController@get");
//Usuario
$router->get("/usuario","UsuarioController@getAll");
$router->get("/usuario/{id}","UsuarioController@get");
$router->post("/usuario","UsuarioController@insert");
$router->post("/usuario/{id}","UsuarioController@update");
$router->post("/usuario/{id}/password","UsuarioController@updatePassword");
$router->delete("/usuario/{id}","UsuarioController@delete");
//Editorial
$router->get("/editorial","EditorialController@getAll");
$router->get("/editorial/{id}","EditorialController@get");
$router->post("/editorial","EditorialController@insert");
$router->post("/editorial/{id}","EditorialController@update");
$router->delete("/editorial/{id}","EditorialController@delete");
//Genero
$router->get("/genero","GeneroController@getAll");
$router->get("/genero/{id}","GeneroController@get");
$router->get("/genero/{id}/libro","GeneroController@getGenero");
$router->post("/genero","GeneroController@insert");
$router->post("/genero/{id}","GeneroController@update");
$router->delete("/genero/{id}","GeneroController@delete");
//Tipo
$router->get("/tipo","TipoController@getAll");
$router->get("/tipo/{id}","TipoController@get");
$router->post("/tipo","TipoController@insert");
$router->post("/tipo/{id}","TipoController@update");
$router->delete("/tipo/{id}","TipoController@delete");
//Libro
$router->get("/libro","LibroController@getAll");
$router->get("/libro/{id}","LibroController@get");
$router->post("/libro","LibroController@insert");
$router->post("/libro/{id}","LibroController@update");
$router->post("/libro/{id}/image","LibroController@updateImage");
$router->delete("/libro/{id}","LibroController@delete");
//Lector
$router->get("/lector","LectorController@getAll");
$router->get("/lector/{id}","LectorController@get");
$router->post("/lector","LectorController@insert");
$router->post("/lector/{id}","LectorController@update");
$router->delete("/lector/{id}","LectorController@delete");
//Prestamo
$router->get("/prestamo","PrestamoController@getAll");
$router->get("/prestamo/{id}","PrestamoController@get");
$router->post("/prestamo","PrestamoController@insert");
$router->post("/prestamo/{id}","PrestamoController@update");
$router->delete("/prestamo/{id}","PrestamoController@delete");