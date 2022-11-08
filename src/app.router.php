<?php
namespace Qiut\Controllers;

use HNova\Db\Client;
use HNova\Rest\req;
use HNova\Rest\res;
use HNova\Rest\router;


router::use(fn() => DbController::connect());

router::post('sign-up', fn() => AccessController::signUp()); // Crear un usuario

router::post('auth', fn() => AccessController::auth()); // Autenticarse

router::get('empres', function(){
    $clien = new Client();
    
    $rows = $clien->execSelect(
        fields: "*",
        table: "info_empres"
    )->rows;
        
    return $rows;
});

router::get('users', fn() => AccessController::userAll());
    
router::use('categories', function(){
    router::get('', fn() => CategoriesController::getAll());
    router::post('', fn() => CategoriesController::createCategory());
    router::delete('/:id', fn() => CategoriesController::deleteCategory());
});

router::use('getproducts', function(){
    router::get('', fn() => ProductsController::getAll());
    router::get('/:id', fn() => ProductsController::getProduct());
});

router::use('media', function(){

    router::get('products/:produc/:name', function(){
        if (req::params()->name == 'default') {
            return res::file("files/products/default.jpg");
        }
        return res::file("files/products/P" . str_pad(req::params()->produc, 5, '0', STR_PAD_LEFT)."/". req::params()->name);
    });
    router::get('products/:produc', function(){
        $path = "files/products/P". str_pad(req::params()->produc, 5, '0', STR_PAD_LEFT). "/";
        return glob($path . "*");
    });

});

router::use(fn() => AccessController::isAuth()); // Verifica la autenticacion

router::use('products', function(){
    router::post('', fn() => ProductsController::createProduct());
    router::put('/:id', fn() => ProductsController::updateProduct());
    router::delete('/:id', fn() => ProductsController::deleteProduct());
});

router::put('logout', fn() => AccessController::logout()); // Cierra la seccion