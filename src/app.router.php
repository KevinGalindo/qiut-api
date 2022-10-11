<?php
namespace Qiut\Controllers;
use HNova\Rest\router;


router::use(fn() => DbController::connect());

router::post('sign-up', fn() => AccessController::signUp()); // Crear un usuario

router::post('auth', fn() => AccessController::auth()); // Autenticarse

router::use('getproducts', function(){
    router::get('', fn() => ProductsController::createProduct());
});

router::use(fn() => AccessController::isAuth()); // Verifica la autenticacion

router::use('products', function(){
    router::post('', fn() => ProductsController::createProduct());
});

router::use('users', function(){
    router::post('', fn() => '');
});

router::put('logout', fn() => AccessController::logout()); // Cierra la seccion