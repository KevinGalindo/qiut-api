<?php

 namespace Controllers;

use HNova\Rest\req;
use Qiut\Models\ProductsModels;

 class products_controller {

    static function getAll(){

        $model = new ProductsModels();

        return $model->getAll();
    }

    static function createProduct(){

        $model = new ProductsModels();

        $data = req::body();

        
        return $model->create($data);
        
    }

 }