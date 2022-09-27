<?php
namespace Qiut\Controllers;
use HNova\Rest\router;

// router::get('/', fn() => 'Hola Mundo');

router::use(fn() => DbController::connect());

router::use(fn() => AccessController::isAuth());


router::post('auth', fn() => AccessController::auth());
router::post('sign-up', fn() => AccessController::signUp());


router::use('products', function(){
    router::post('', fn() => ProductsController::createProduct());
});

router::use('users', function(){
    router::post('', fn() => '');
});