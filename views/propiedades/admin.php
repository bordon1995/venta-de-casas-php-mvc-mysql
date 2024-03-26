<?php

$inicio = 'inicio';

use Models\UI;

$propiedades;

?>
<main>

    <section class="section">
        <div class="nav-section">
            <h2>Mis Propiedades</h2>
            <a href="/propiedades/crear?id=<?php echo  $_GET['id'] ?>">Nueva Propiedad</a>
        </div>
    </section>
    <div class="contenido_cards">
        <?php if (isset($propiedades)) {
            $view = new UI;
            $view->mostrarPropiedades($propiedades);
        } ?>
    </div>
    <section>
        <div class="contenido_cards">
        </div>
    </section>

</main>