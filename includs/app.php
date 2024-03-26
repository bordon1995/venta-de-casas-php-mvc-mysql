<?php

require './config/funcion.php';
require './config/db.php';
require __DIR__ . '/../vendor/autoload.php';

//conectar DB
$db = conectardb();

use App\ActiveRecord;

ActiveRecord::setDB($db);
