<?php

use Models\UI;

$validacion;

?>

<main class="main_login">
    <form method="POST" action="">
        <fieldset class="formulario-login">
            <legend>Rellena los campos con tus datos</legend>

            <?php if (isset($validacion)) {
                $view = new UI;
                $view->mostrarError($validacion);
            }; ?>

            <label for="gmail">Correo</label>
            <input value="<?php echo sanitizar($usuario->gmail ?? ''); ?>" name="gmail" class="input-login" id="gmail" type="email" placeholder="Tu Correo">

            <label for="password">Password</label>
            <input name="password" class="input-login" id="password" type="password" placeholder="Tu password">

            <input class="boton" type="submit" value="Ingresar">
        </fieldset>
    </form>
</main>