<?php

namespace Model;

class ActiveRecord {
    
    //base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    //errores
    protected static $errores = [];


    //definir la conexion a la BD
    public static function setDB($database){
        self::$db = $database;
    }

    public function crear(){
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //insertar el la base de datos 
        $query = "INSERT INTO ".static::$tabla." ( "; $query .= join(', ', array_keys($atributos)); $query .=" ) VALUES (' "; $query .= join("', '", array_values($atributos)); $query .= " ') ";
        
        $resultado = self::$db->query($query);
        
        if($resultado){
            //redireccionar al usario.
            header('location: /admin?resultado=1');
        }
        
    }

    public function guardar() {
        if(!is_null($this->id)){
            //actualizando
            $this->actualizar();
        }else {
            //creando un nuevo registro
            $this->crear();
        }
    }

    public function actualizar() {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " .static::$tabla. " SET "; $query .= join(', ',$valores); $query .= " WHERE id='".self::$db->escape_string($this->id). "'"; $query .= "LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado){
            //redireccionar al usario.
            header('location: /admin?resultado=2');
        }

        return $resultado;
    }

    public function Eliminar() {
        $query = "DELETE FROM " .static::$tabla. " WHERE id=". self::$db->escape_String($this->id). " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id')continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }


    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    //subida DE archivos
    public function setImagen($imagen) {
        // eliminar la imagen previa 
        if(!is_null( $this->id )){
            $this->borrarImagen();
        }
        if($imagen) {
            //asignar al atributo de imagen un valor imagen
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //validacion
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    //lista todas la propiedades
    public static function all() {
        $query = "SELECT * FROM ". static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //obtiene dereminado numero de registro.
    public static function get($cantidad) {
        $query = "SELECT * FROM ". static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    //busca una propieadad en especifico
    public static function find($id) {

        $query ="SELECT * FROM " .static::$tabla. " WHERE id=$id";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }


    public static function consultarSQL($query) {
        //consultar la bd
        $resultado = self::$db->query($query);
        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
            
        }
        //liberar la memoria 
        $resultado->free();
        //retornal los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key )){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //sincronizar el objeto en memoria con los cambios realizados en actulizar.php
    public function sincronizar($args = []) {
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
        
    }
}