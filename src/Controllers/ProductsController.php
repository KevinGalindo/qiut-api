<?php

 namespace Qiut\Controllers;

use HNova\Rest\req;
use HNova\Rest\res;
use Qiut\Models\ProductsModels;

 class ProductsController {

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
        $images = req::files(); # Lista de las imagenes
        $data = req::body()->data;
        $imgDelete = req::body()->deleteImgs;


        $model = new ProductsModels();

        // Actualizamos el producto
        $model->update($id, $data);

        $idImg = str_pad($id, 5, '0', STR_PAD_LEFT);
        $path = "files/products/P$idImg/";

        if (!file_exists($path)) mkdir($path);

        foreach($images as $file){
            $file->save($path . $file->name);
        }

        foreach($imgDelete as $img){
            unlink($path . $img);
        }

        $obj = $model->get($id);

        return $obj;

    }

    static function createProduct(){
        return require __DIR__ . '/scripts/products/product-post.php';
    }

 }