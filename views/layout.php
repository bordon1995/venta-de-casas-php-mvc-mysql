<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>Document</title>
</head>

<body>
    <header class=" header <?php echo $inicio ?? '' ?>">

        <div class="head">
            <h1>bienes raises</h1>
            <a class="head_a" href="/logoauth">Serrar Sesion</a>
        </div>

    </header>

    <?php echo $contenido; ?>

</body>