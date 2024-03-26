<?php

namespace Models;

class ActiveRecord
{
    protected static $db;
    protected static $tabla;
    protected static $columnasDB = array();
    protected static $validacion = array();

    public static function setDB($conecionDB)
    {
        self::$db = $conecionDB;
    }

    public function getAtributos()
    {
        $datosUsuario = [];
        foreach (static::$columnasDB as $columna) {
            $datosUsuario[$columna] = $this->$columna;
        };
        return $datosUsuario;
    }

    public function actualizar($post)
    {
        foreach (static::$columnasDB as $value) {
            foreach ($post as $key => $val) {
                if ($value === $key) {
                    $this->$value = $val;
                };
            };
        };
    }

    public function sanitizarAtributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        };
        foreach ($atributos as $key => $value) {

            $atributos[$key] = self::$db->escape_string($value);
        };
        return $atributos;
    }

    public function guardarDB()
    {

        $datosPropiedad = $this->sanitizarAtributos();

        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($datosPropiedad));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($datosPropiedad));
        $query .= "' ) ;";

        $resultado = self::$db->query($query);

        if ($resultado) {
            return true;
        };
    }

    public static function getUsuario($gmail)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE gmail = '$gmail';";
        $resul = self::$db->query($query);
        $validacion = $resul->fetch_assoc();

        if ($validacion) {
            return $validacion;
        };
        return false;
    }

    public static function getPropiedad($idPropiedad)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id  = $idPropiedad;";
        $resul = self::querySQL($query);

        return array_shift($resul);
    }

    public static function getAllPropiedades($id_usuario)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE vendedor_id = $id_usuario;";
        $resul = self::querySQL($query);

        return $resul;
    }

    protected static function querySQL($query)
    {
        $resul = self::$db->query($query);

        while ($registro = $resul->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            };
        };

        return $objeto;
    }

    public function actalizarDB($propiedad_id)
    {

        $datosPropiedad = $this->sanitizarAtributos();

        $titulo = $datosPropiedad['titulo'];
        $precio = $datosPropiedad['precio'];
        $imagen = $datosPropiedad['imagen'];
        $descripcion = $datosPropiedad['descripcion'];
        $habitaciones = $datosPropiedad['habitaciones'];
        $wc = $datosPropiedad['wc'];
        $estacionamiento = $datosPropiedad['estacionamiento'];
        $fecha = $datosPropiedad['fecha'];

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= "titulo='$titulo',precio='$precio',imagen='$imagen',descripcion='$descripcion',";
        $query .= "habitaciones='$habitaciones',wc='$wc',estacionamiento='$estacionamiento',";
        $query .= "fecha='$fecha' WHERE id = '$propiedad_id' ;";


        $resultado = self::$db->query($query);

        if ($resultado) {
            return true;
        }
    }

    protected static function deleteFile($id_propiedad)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id_propiedad";
        $propiedad = self::$db->query($query);
        $resul = $propiedad->fetch_assoc();

        unlink('imagenes/' . $resul['imagen']);
        return $resul;
    }

    public static function eliminarDB($id_propiedad)
    {
        $id_usuario = self::deleteFile($id_propiedad);

        $query = "DELETE FROM " . static::$tabla . " WHERE id = $id_propiedad;";
        $respuesta = self::$db->query($query);

        if ($respuesta) {
            header('Location:/admin?id=' . $id_usuario['vendedor_id']);
        };
    }
}
