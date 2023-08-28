<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error){ ?>
            <p class="alerta error"><?php echo $error;?></p>
        <?php }?>
        
        <form method="POST" class="formulario" action="/login">
            <fieldset>
                <legend>Email y Password</legend>
                <label for="e-mail">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="e-mail" >
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password" >
            </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>