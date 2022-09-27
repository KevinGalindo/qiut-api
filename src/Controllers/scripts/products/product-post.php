<?php

use HNova\Rest\req;
use Qiut\Models\ProductsModels;
use Qiut\qiut;

$model = new ProductsModels();

$product = $model->create(req::body());

return $product;