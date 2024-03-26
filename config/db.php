<?php

function conectardb()
{
    $db = new mysqli('localhost', 'root', 'root', 'bienes_raices');
    if (!$db) {
        echo 'no se pudo conectar';
        exit;
    };

    return $db;
};
