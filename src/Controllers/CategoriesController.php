<?php

namespace Qiut\Controllers;

use HNova\Rest\req;
use HNova\Rest\res;
use Qiut\Models\CategoriesModels;

class CategoriesController{

    static function getAll(){
        $model = new CategoriesModels();

        return $model->getAll();
    }

    static function createCategory(){
        $data = req::body();

        $model = new CategoriesModels();

        if (!$model->getCateName($data->name)) {
            return res::json([
                'message' => 'Este nombre ya esta en uso'
            ], 400);
        }

        $cate = $model->create($data);

        return $cate;
    }

    static function deleteCategory(){
        $id = req::params()->id;

        $model = new CategoriesModels();

        $res = $model->delete($id);

        if ($res) {
            return res::json([
                'status' => true,
                'mesaje' => 'Se elimino con exito'
            ]);
        }

        return res::json([
            'status' => false,
            'mesaje' => 'Ocurrio algun error'
        ]);
    }

}