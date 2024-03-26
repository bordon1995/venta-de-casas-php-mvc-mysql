<?php

use Models\UI;

$propiedad;
$validacion;

?>

<main>
    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Rellena los campos con tus datos</legend>

            <?php if (isset($validacion)) {
                $view = new UI;
                $view->mostrarError($validacion);
            }; ?>

            <div class="contenedor-input">
                <label class="formulario-login" for="titulo">Titulo</label>
                <input value="<?php echo sanitizar($propiedad->titulo ?? ''); ?>" class="input" id="titulo" name="titulo" type="text">
            </div>
            <div class="contenedor-input">
                <label class="formulario-login" for="precio">Precio</label>
                <input value="<?php echo sanitizar($propiedad->precio ?? ''); ?>" class="input" id="precio" name="precio" type="number">
            </div>

            <div class="contenedor-input">
                <label class="formulario-login" for="imagen">Imagen</label>
                <input value="<?php echo sanitizar($propiedad->imagen) ?? '' ?>" class="input" id="imagen" name="imagen" type="file" accept="image/jpeg, image/png">
                <?php if (isset($propiedad->imagen)) { ?>
                    <img src="<?php echo '/imagenes/' . $propiedad->imagen ?? '' ?>" alt="imagen de la propiedad">
                <?php } ?>
            </div>

            <div class="contenedor-input">
                <label class="formulario-login" for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="3"><?php echo sanitizar($propiedad->descripcion ?? ''); ?></textarea>
            </div>

            <div class="contenedor-input">
                <label class="formulario-login" for="habitaciones">Habitaciones</label>
                <input value="<?php echo sanitizar($propiedad->habitaciones ?? ''); ?>" class="input" id="habitaciones" name="habitaciones" type="number">
            </div>

            <div class="contenedor-input">
                <label class="formulario-login" for="wc">Wc</label>
                <input value="<?php echo sanitizar($propiedad->wc ?? ''); ?>" class="input" id="wc" name="wc" type="number">
            </div>

            <div class="contenedor-input">
                <label class="formulario-login" for="estacionamiento">Estacionamiento</label>
                <input value="<?php echo sanitizar($propiedad->estacionamiento ?? ''); ?>" class="input" id="estacionamiento" name="estacionamiento" type="number">
            </div>
            <input type="submit" value="Publicar" name="<?php $id_usuario ?? '' ?>">
        </fieldset>
    </form>
</main>