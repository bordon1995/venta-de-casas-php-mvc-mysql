<?php

require_once __DIR__ . '/../config/funcion.php';
require_once __DIR__ . '/../config/db.php';
require_once  __DIR__ . '/../vendor/autoload.php';

//conectar DB
$db = conectardb();

use Models\ActiveRecord;

ActiveRecord::setDB($db);
