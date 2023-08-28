<fieldset>
                <legend>Informacion General</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="vendedor[nombre]" placeholder="nombre vendedor(a)" value="<?php echo s($vendedor->nombre);?>">

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="vendedor[apellido]" placeholder="apellido vendedor(a)" value="<?php echo s($vendedor->apellido);?>">

                <label for="telefono">Telefono:</label>
                <input type="number" id="telefono" name="vendedor[telefono]" placeholder="telefono vendedor(a)" pattern="[0-9]{10}" value="<?php echo s($vendedor->telefono);?>">

</fieldset>

