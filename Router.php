<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;

    }
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;

    }

    public function comprobarRutas() {

        session_start();
        $auth = $_SESSION['login'] ?? NULL;
        //arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar' ,'/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar' ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];


            if($metodo === 'GET') {
                $fn = $this->rutasGET[$urlActual] ?? NULL;
            }else {
                $fn = $this->rutasPOST[$urlActual] ?? NULL;
            }
        
        //proteger las rutas 
            if(in_array($urlActual, $rutas_protegidas) && !$auth) {
                header('location: /');
            }

            if($fn) {
                call_user_func($fn, $this);
            }else {
                echo 'pagina no encontrada';
            }
        
    }

    //muestra una vista 
    public function render($view, $datos=[]){
        foreach($datos as $key => $value){
            $$key = $value; // vonvertir el atributo del array en una variable
        }
        ob_start(); //almacenamiento en memoria durante un momento..
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // limpiar el buffer
        include __DIR__ . "/views/layout.php";
    }

}