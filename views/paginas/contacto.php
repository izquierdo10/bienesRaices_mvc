
<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php if($mensaje) { ?>
            <p class='alerta exito'><?php echo $mensaje; ?></p>;
        <?php } ?>
        

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2>Llene el formulario de Contacto</h2>

        <form class="formulario" method="POST" action="/contacto" >
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende o Compra:</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>--seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" min="0" placeholder="Precio o Presupuesto" id="presupuesto" name="contacto[precio]" required>
            </fieldset>
            <fieldset>
                <legend>Información Para contactarlo(a)</legend>
                <p>como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input  type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                    <label for="contactar-E-mail">E-mail</label>
                    <input  type="radio" value="Email" id="contactar-E-mail" name="contacto[contacto]" required>
                </div>

                <div id="contacto"></div>


            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>