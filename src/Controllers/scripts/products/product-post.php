<?php

use HNova\Rest\req;
use Qiut\Models\ProductsModels;

$model = new ProductsModels();

$data = req::body()->data; # Información del product
$images = req::files(); # Lista de las imagenes


# creamos el productos
$obj = $model->create($data);


$id = str_pad($obj->id, 5, '0', STR_PAD_LEFT);
$path = "files/products/P$id/";

if (!file_exists($path)) mkdir($path);

foreach($images as $file){

    if ($file->save($path . $file->name)) {
        $obj->images[] = $file->name;
    }
}

return $obj;
