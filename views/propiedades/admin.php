<main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php 
            if($resultado) {
                $mensaje = mostrarNotificacion(intval($resultado));
                if($mensaje){ ?>
                    <p class="alerta exito"><?php echo s($mensaje) ?></p>
            <?php } 
            } ?>

        <hr>

        <h2>Propiedades</h2>
        <a href="propiedades/crear" class="boton boton-verde-block ">Crear Propiedad</a>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th> 
                </tr>
            </thead>

            <tbody><!-- mostrar los resultados-->
                <?php foreach( $propiedades as $Propiedad ) { ?>
                    <tr>
                        <td><?php echo $Propiedad->id; ?></td>
                        <td><?php echo $Propiedad->titulo; ?></td>
                        <td><img src="../imagenes/<?php echo $Propiedad->imagen; ?>" class="imagen-tabla"></td>
                        <td>$<?php echo number_format($Propiedad->precio, 2, ',', '.');?></td>
                        <td>
                            <form method="POST" class="W-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $Propiedad->id;?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="propiedades/actualizar?id=<?php echo $Propiedad->id ; ?>"class="boton-azul-block">Actualizar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <h2>vendedores</h2>
        <a href="/vendedores/crear" class="boton boton-verde-block ">crear Vendedor</a>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>apellido</th>
                    <th>telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody><!-- mostrar los resultados-->
                <?php foreach( $vendedores as $vendedor ) { ?>
                    <tr>
                        <td><?php echo $vendedor->id; ?></td>
                        <td><?php echo $vendedor->nombre; ?></td>
                        <td><?php echo $vendedor->apellido; ?></td>
                        <td><?php echo substr($vendedor->telefono, 0, 3) . ' ' . substr($vendedor->telefono, 3, 3) . ' ' . substr($vendedor->telefono, 6,4); ?></td>
                        <td>
                            <form method="POST" class="W-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id;?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="/vendedores/actualizar?id=<?php echo $vendedor->id ; ?>"class="boton-azul-block">Actualizar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</main>