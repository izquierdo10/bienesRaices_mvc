<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {

    public static function crear(Router $router) { 
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        if($_SERVER ['REQUEST_METHOD']=== 'POST') {
            //creaR una nueva instancia 
    
            $vendedor = new Vendedor($_POST['vendedor']); 
            
            //validar que no hayan campos vacios 
            $errores =$vendedor->validar();
    
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router) {
        $id = vlidarOredireccionar('/admin');
        // Obtener los datos del vendedor a editar...
        $vendedor = Vendedor::find($id);

        $errores = Vendedor::getErrores();

        // Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);

            // Validación
            $errores = $vendedor->validar();

            if(empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            //validar id
            $id = $_POST['id'];
            $id = filter_var($id ,FILTER_VALIDATE_INT);
    
            if($id){
                $tipo = $_POST['tipo'];
    
                if(validarTipoConetnido($tipo)) {
                    $vendedor = vendedor::find($id);
                    $vendedor->eliminar();
                }
    
            }
        } 
    }
}