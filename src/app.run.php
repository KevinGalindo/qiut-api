<?php

use HNova\Rest\apirest;

$app = apirest::createServer();

$app->requestLogOff(); // Deshabilita el registro de acceos en al API
$app->use("/", fn() => require __DIR__ . "/app.router.php");
$app->run();
