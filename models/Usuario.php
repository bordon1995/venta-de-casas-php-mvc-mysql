<?php

namespace Models;

use Models\ActiveRecord;

class Usuario extends ActiveRecord
{
    //base de datos
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'password', 'gmail'];
    protected static $tabla = 'vendedor';
    protected static $validacion = array();

    //propiedades
    public $id;
    public $nombre;
    public $apellido;
    public $gmail;
    public $telefono;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->gmail = $args['gmail'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validarRegistro()
    {
        $datosUsuario = $this->getAtributos();
        foreach ($datosUsuario as $key => $value) {
            if ($value === '') {
                if (!static::$validacion['stringVacio']) {
                    static::$validacion['stringVacio'] = 'Todos los Campos son obligatorios';
                };
            };
            if ($key === 'gmail') {
                if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                    static::$validacion['gmail'] = 'El email no es valido';
                };
                $resultado = self::getUsuario($datosUsuario['gmail']);
                if ($resultado) {
                    static::$validacion['gmailExistente'] = 'El email ingresado ya se encuentra registrado';
                };
            };
        };
        return static::$validacion;
    }

    public static function validarLogin($_post)
    {
        foreach ($_post as $key => $value) {
            if ($value === '') {
                if (!static::$validacion['stringVacio']) {
                    static::$validacion['stringVacio'] = 'Todos los Campos son obligatorios';
                };
            };
            if ($key === 'gmail') {
                $validacion = self::getUsuario($value);
                if ($validacion === false) {
                    static::$validacion['usuario'] = 'El correo ingresado no se encuentra registrado';
                };
            };
        };
        return static::$validacion;
    }
}
