<?php

require_once __DIR__ . '/../funciones/app.php';

use MVC\Router;
use Controllers\PropiedadController;

$router = new Router();

$router->get('/', [PropiedadController::class, 'login']);
$router->post('/', [PropiedadController::class, 'login']);

$router->get('/registro', [PropiedadController::class, 'registro']);
$router->post('/registro', [PropiedadController::class, 'registro']);

$router->get('/admin', [PropiedadController::class, 'index']);
$router->post('/admin', [PropiedadController::class, 'eliminar']);

$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);

$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

$router->get('/logoauth', [PropiedadController::class, 'logoauth']);

$router->session();
