<?php

use Models\UI;

$validacion;

?>

<main>
    <form method="POST" action="">
        <fieldset class="formulario-login">
            <legend>Rellena los campos con tus datos</legend>

            <?php if (!empty($validacion)) {
                $view = new UI;
                $view->mostrarError($validacion);
            }; ?>

            <label for="nombre">Nombre</label>
            <input value="<?php echo sanitizar($nuevoUsuario->nombre ?? ''); ?>" name="nombre" class="input-login" id="nombre" type="text" placeholder="Tu Nombre">

            <label for="apellido">Apellido</label>
            <input value="<?php echo sanitizar($nuevoUsuario->apellido ?? ''); ?>" name="apellido" class="input-login" id="apellido" type="text" placeholder="Tu Apellido">

            <label for="gmail">Correo</label>
            <input value="<?php echo sanitizar($nuevoUsuario->gmail ?? ''); ?>" name="gmail" class="input-login" id="gmail" type="email" placeholder="Tu Correo">

            <label for="telefono">Telefono</label>
            <input value="<?php echo sanitizar($nuevoUsuario->telefono ?? ''); ?>" name="telefono" class="input-login" id="telefono" type="number" placeholder="Tu Telefono">

            <label for="password">Password</label>
            <input name="password" class="input-login" id="password" type="text" placeholder="Tu password">

            <input class="boton" type="submit" value="Ingresar">
        </fieldset>
    </form>
</main>