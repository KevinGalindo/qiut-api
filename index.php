<?php

use HNova\Rest\apirest;

    require __DIR__ .'/vendor/autoload.php';

    $app = apirest::createServer();

    $app->use( '/', fn()=> require __DIR__ .'/router.php');

    $app->run();