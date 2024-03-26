<?php

namespace MVC;

class Router
{
    public $session = ['/admin', '/formulario'];
    public $rutasGET = array();
    public $rutasPOST = array();

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function session()
    {
        $uriActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $resultado = in_array($uriActual, $this->session);

        if ($resultado) {
            session_start();

            if (!empty($_SESSION)) {
                $this->comprobarRutas($uriActual);
            } else {
                header('Location:/');
            };
        } else {
            $this->comprobarRutas($uriActual);
        };
    }

    public function comprobarRutas($urlActual)
    {
        $metod = $_SERVER['REQUEST_METHOD'];

        if ($metod === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        };

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo 'Pagina no encontrada';
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $valor) {
            $$key = $valor;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}
