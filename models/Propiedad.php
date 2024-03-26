<?php

namespace Models;

use Models\ActiveRecord;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedad';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'fecha', 'vendedor_id'];
    protected static $validacion = array();

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $fecha;
    public $vendedor_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->vendedor_id = $args['vendedor_id'] ?? '';
    }

    public function getFile($file)
    {
        if ($file['name'] === '') {
            if ($this->id !== null) {
                return;
            };
            static::$validacion['imagen'] = 'Es necesario subir una imagen';
        } else {
            $file['name'] = $this->imagen;
            $this->imagen = $file;
        }
    }



    public function validarPropiedad($_file)
    {

        $this->getFile($_file);

        $propiedad = $this->getAtributos();

        foreach ($propiedad as $key => $value) {
            if ($value === '') {
                if (!isset(static::$validacion['stringVacio'])) {
                    static::$validacion['stringVacio'] = 'Todos los campos son obligatorios';
                };
            };
            if ($key === 'descripcion') {
                if (strlen($value) < 10) {
                    static::$validacion['descripcion'] = 'La descripcion no puede ser menor a 10 caracteres';
                };
            };
        };
        return static::$validacion;
    }

    public function guardarPropiedad()
    {
        if (isset($this->imagen['name'])) {
            $carpetaImagenes = 'imagenes/';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            };

            if ($this->id !== null) {
                unlink($carpetaImagenes . $this->imagen['name']);
            };

            $nombreImagen = md5(uniqid(rand(), true)) . $this->imagen['full_path'];


            move_uploaded_file($this->imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            $this->imagen = $nombreImagen;
        };
    }
}
