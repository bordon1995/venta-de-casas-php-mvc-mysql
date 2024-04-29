<?php

namespace Controllers;

use MVC\Router;
use Models\Propiedad;
use Models\Usuario;

class PropiedadController
{
    public static function registro(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuevoUsuario = new Usuario($_POST);
            $validacion = $nuevoUsuario->validarRegistro();
            if (empty($validacion)) {
                $resultado = $nuevoUsuario->guardarDB();
                if ($resultado === true) {
                    $id_usuario = $nuevoUsuario::getUsuario($nuevoUsuario->gmail);
                    session_start();
                    $_SESSION['id'] = $id_usuario['id'];
                    header('Location:/admin?id=' . $_SESSION['id']);
                };
            };
        };

        $router->render('/propiedades/registro', [
            'nuevoUsuario' => $nuevoUsuario,
            'validacion' => $validacion
        ]);
    }

    public static function login(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validacion = Usuario::validarLogin($_POST);

            if (empty($validacion)) {
                $usuario = Usuario::getUsuario($_POST['gmail']);
                session_start();
                $_SESSION['id'] = $usuario['id'];
                header('Location:/admin?id=' . $_SESSION['id']);
            };
        };

        $router->render('/propiedades/login', [
            'validacion' => $validacion,
            'usuario' => $usuario
        ]);
    }

    public static function index(Router $router)
    {
        $id_usuario = $_SESSION['id'];
        if (!empty($id_usuario)) {
            $propiedades = Propiedad::getAllPropiedades($id_usuario);
        };

        $router->render('/propiedades/admin', [
            'propiedades' => $propiedades
        ]);
    }

    public static function crear(Router $router)
    {
        $id_usuario = filter_var($_GET['id'], FILTER_VALIDATE_INT);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['vendedor_id'] = $id_usuario;
            $propiedad = new Propiedad($_POST);
            $validacion = $propiedad->validarPropiedad($_FILES['imagen']);

            if (empty($validacion)) {
                $propiedad->guardarPropiedad();
                $resultado = $propiedad->guardarDB();
                if ($resultado) {
                    header('Location:/admin?id=' . $id_usuario);
                };
            };
        };

        $router->render('/propiedades/formulario', [
            'propiedad' => $propiedad,
            'validacion' => $validacion
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

        if (!empty($id)) {
            $propiedad = Propiedad::getPropiedad($id);
        };

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad->actualizar($_POST);
            $validacion = $propiedad->validarPropiedad($_FILES['imagen']);

            if (empty($validacion)) {
                $propiedad->guardarPropiedad();
                $resultado = $propiedad->actalizarDB($id);
                if ($resultado === true) {
                    header('Location:/admin?id=' . $propiedad->vendedor_id);
                };
            }
        };

        $router->render('/propiedades/formulario', [
            'propiedad' => $propiedad,
            'validacion' => $validacion
        ]);
    }

    public static function eliminar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_propiedad = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            Propiedad::eliminarDB($id_propiedad);
        };
    }

    public static function logoauth()
    {
        session_start();
        $_SESSION = [];
        header('Location:/');
    }
}
