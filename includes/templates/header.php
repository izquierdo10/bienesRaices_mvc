<?php
    
    if(!isset($_SESSION)){ // no duplicar el inicio de sesio
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices_inicio_php/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices_inicio_php/index.php">
                    <img src="/bienesraices_inicio_php/build/img/logo.png" alt="logotipo de bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesraices_inicio_php/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/bienesraices_inicio_php/build/img/dark-mode.svg">
                    <nav class="nav">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if($auth){?>
                                <a href="cerrar-sesion.php">cerrar sesion</a>
                            <?php }?>

                    </nav>
                </div>

            </div><!--.barra-->

            <?php if($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>