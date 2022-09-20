<?php

namespace Controllers;
use HNova\Rest\router;

router::use(fn() => DbController::connect());

router::post('/auth' ,fn() => AccessController::auth());

router::use(fn() => AccessController::isAuth());

// Rutas para los productos
router::use('/products', function(){

    router::get('', fn() => products_controller::getAll());
    router::post('', fn() => products_controller::createProduct());

});