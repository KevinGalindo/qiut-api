<?php

namespace Qiut\Controllers;

use Qiut\Models\CategoriesModels;

class CategoriesController{

    static function getAll(){
        $model = new CategoriesModels();

        return $model->getAll();
    }

}