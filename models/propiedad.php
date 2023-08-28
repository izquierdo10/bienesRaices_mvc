<?php

namespace Model;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'] ;

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args['id']?? NULL;
        $this->titulo = $args['titulo']?? '';
        $this->precio = $args['precio']?? '';
        $this->imagen = $args['imagen']?? '';
        $this->descripcion = $args['descripcion']?? '';
        $this->habitaciones = $args['habitaciones']?? '';
        $this->wc = $args['wc']?? '';
        $this->estacionamiento = $args['estacionamiento']?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id']?? '';
    }

    public function validar() {
                //FILES

        if(!$this->titulo){
            self::$errores[] = "debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores[] = "debes añadir un precio";
        }
        if((!$this->imagen)){
            self::$errores[] = "La imagen es obligatoria";
        }
        if( strlen($this->descripcion) < 20){
            self::$errores[] = "debes añadir una descripcion con almenos 20 letras";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El numero de Habitaciones debe ser mayor a 0";
        }
        if(!$this->wc){
            self::$errores[] = "El numero de baños debe ser mayor a 0";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El numero de estacionamiento es obligatorio";
        }
        if(!$this->vendedores_id){
            self::$errores[] = "El vendedor es obligatorio";
        }

        return self::$errores;
    }


}