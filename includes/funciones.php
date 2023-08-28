<?php

define('TEMPLATES_URL',__DIR__ . '/templates');
define('FUNCIONES_URL',__DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT']. '/imagenes/');

function inclurTemplate (string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado(){
    session_start();

    if(!$_SESSION['login']){
        header('location: /bienesraices_inicio_php');
    }
    return true;

}

function debuguear($deb) {
    echo "<pre>";
    var_dump($deb);
    echo "</pre>";
    exit;
}

//  Escapa /sanitizar el HTML 
function s($html): string {
    $s = htmlspecialchars($html);
    return $s;
}
// valiar tipo de contenido 

function validarTipoConetnido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Propiedad Creada Correctamente';
            break;
        case 2:
            $mensaje = 'Propiedad Actualizada Correctamente';
            break;
        case 3:
            $mensaje = 'Propiedad Eliminada Correctamente';
            break;
        // case 4:
        //     $mensaje = 'Vendedor Registrado Correctamente';
        //     break;
        // case 5:
        //     $mensaje = 'Vendedor Actualizado Correctamente';
        //     break;
        // case 6:
        //     $mensaje = 'Vendedor Eliminado Correctamente';
        //     break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function vlidarOredireccionar(string $url) {
        //validar el id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if(!$id) {
            header("location: $url");
        }
        return $id;
}