<?php

namespace Models;

class UI
{
    public function mostrarError($array)
    {
        foreach ($array as $error) {
?>
            <div class="prueva">
                <p><?php echo $error ?> </p>
            </div>
        <?php
        };
    }

    public function mostrarPropiedades($array)
    {
        foreach ($array as $propiedad) {

        ?>
            <div class="cards">
                <div>
                    <img class="publicidad" src="<?php echo '/imagenes/' . $propiedad->imagen ?>" alt="imagen de la propiedad" />
                </div>
                <div class="cards_p">
                    <p><?php echo $propiedad->titulo ?></p>
                    <p><span>Precio :</span><?php echo " $" . $propiedad->precio ?></p>
                    <p><span>Habitaciones: </span><?php echo $propiedad->habitaciones ?></p>
                    <p><span>Baños :</span><?php echo $propiedad->wc ?></p>
                    <p><span>Estacionamiento :</span><?php echo $propiedad->estacionamiento ?></p>
                </div>
                <div class="cards_p">
                    <p><span>Descripcions :</span> </span><?php echo $propiedad->descripcion ?></p>
                </div>
                <div class="enlaces">
                    <a class="editar" href="/propiedades/actualizar?id=<?php echo $propiedad->id ?>">Editar</a>
                    <form class="form_buttom" action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                        <input type="submit" class="eliminar" value="Eliminar">
                    </form>
                </div>
            </div>
<?php
        };
    }
}
