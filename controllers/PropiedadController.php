<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $resultado = $_GET['resultado'] ?? null;
        $vendedores = Vendedor::all();

        $router->render('propiedades/admin', [
            'propiedades'=>$propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router) {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER ['REQUEST_METHOD']=== 'POST') {

            $propiedad = new Propiedad($_POST['propiedad']);
    
            //generar nombre unico de img
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
    
            //setear la imagen
            //realiza un resize a la imagen con intervention
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad ->setImagen($nombreImg);
            }

            //validar 
            $errores = $propiedad->validar();
    
            //revisar que el array de errores este vacio
            if(empty($errores)){
                
                // crear carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                }
                //guardar la imagen en el server
                $image->save(CARPETA_IMAGENES. $nombreImg);
                //guardar en la BD
                $propiedad->guardar();
    
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = vlidarOredireccionar('/admin');
        $propiedad= Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        if($_SERVER ['REQUEST_METHOD']=== 'POST') {

            //asignar los atributos 
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
            //validacion 
            $errores = $propiedad->validar();
    
            //generar nombre unico de img
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
    
            // subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad ->setImagen($nombreImg);
            }
    
            //revisar que el array de errores este vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    //almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImg);
                    //guardar cambios 
                }
                $propiedad->guardar();
            }
    
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
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
                    $Propiedad = Propiedad::find($id);
                    $Propiedad->eliminar();
                }
    
            }
        } 
    }
}