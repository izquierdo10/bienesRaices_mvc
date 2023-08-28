<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;


class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades'=> $propiedades,
            'inicio' =>  $inicio
        ]);
    }

    public static function nosotros(Router $router) {

        $router->render('paginas/nosotros', []);

    }

    public static function anuncios(Router $router) {
        $propiedades = Propiedad::all();

        $router->render('paginas/anuncios', [
            'propiedades'=> $propiedades,
        ]);
    }

    public static function anuncio(Router $router) {
        //validar el id
        $id = vlidarOredireccionar('/');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/anuncio', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $router->render('paginas/blog', []);
    }

    public static function entrada(Router $router) {
        $router->render('paginas/entrada', []);
    }

    public static function contacto(Router $router) {
        
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

            $respuestas = $_POST['contacto'];
            //crear una instancia de PHPMailer 
            $mail = new PHPMailer();
            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '6fc385a3200d52';
            $mail->Password = '08c3ae7578f265';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            //configurar el contenido de mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesracies.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';
            //habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            //definir el contenido
            $contenido= '<html>';
            $contenido .=  '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: '.$respuestas['nombre'].' </p>';

            //enviar de forma condicional algunos campos de email o telefon
            if($respuestas['contacto'] === 'telefono'){  
                $contenido .= '<p>telefono: '.$respuestas['telefono'].' </p>';
                $contenido .= '<p>fecha: '.$respuestas['fecha'].' </p>';
                $contenido .= '<p>hora: '.$respuestas['hora'].' </p>';
            }else {
                $contenido .= '<p>email: '.$respuestas['email'].' </p>';
            }

            $contenido .= '<p>mensaje: '.$respuestas['mensaje'].' </p>';
            $contenido .= '<p>tipo: '.$respuestas['tipo'].' </p>';
            $contenido .= '<p>precio: $'.$respuestas['precio'].' </p>';
            $contenido .= '<p>prefiere ser contactado por: '.$respuestas['contacto'].' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo HTML';
            //enviar el email
            if($mail->send()){
                $mensaje = "mensaje enviado correctamente!!";
            } else {
                $mensaje = "el mensaje no se pudo enviar";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }

    
}