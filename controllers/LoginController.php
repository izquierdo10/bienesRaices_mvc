<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;


class loginController {
    public static function login(Router $router) {
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST')   {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if(empty($errores)){
                //verificar si el usario existe
                $resultado = $auth->existeUsuario(); 

                if(!$resultado){
                    //verifcar el usario
                    $errores = Admin::getErrores();
                }else {
                    //verificar el password
                    $autenticado = $auth ->comrobarPassword($resultado);

                    if($autenticado) {
                        //autenticar el usario
                        $auth->autenticar();
                    }else {
                        $errores = Admin::getErrores();
                    }
                    
                }

            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    public static function logout() {
        session_start();

        $_SESSION = [];

        header('location: /');
    }
}