<?php

 namespace Controllers;

use HNova\Rest\req;
use HNova\Rest\res;
use Qiut\Models\ProductsModels;

 class products_controller {

    static function getAll(){

        $model = new ProductsModels();

        return $model->getAll();
    }

    static function getProduct(){

        $id = req::params()->id;

        $model = new ProductsModels();

        $resp = $model->get($id);

        if ($resp) {
           return $resp;
        }

        return res::json([
            "status" => false,
            "message" => "Producto no existe"
        ], 404);

    }

    static function deleteProduct(){

        $id = req::params()->id;

        $model = new ProductsModels();

        return $model->delete($id);

    }

    static function updateProduct(){

        $id   = req::params()->id;
        $data = req::body();

        $model = new ProductsModels();

        return $model->update($id,$data);

    }

    static function createProduct(){

        $model = new ProductsModels();

        $data = req::body();

        
        return $model->create($data);
        
    }

 }