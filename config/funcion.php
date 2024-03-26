<?php

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

function sanitizar($html)
{
    $resul = htmlspecialchars($html);
    return $resul;
}
