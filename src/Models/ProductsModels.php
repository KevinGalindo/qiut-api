<?php

namespace Qiut\Models;

use HNova\Rest\apirest;
use Qiut\Models\Entities\ProductInfo;
use Qiut\qiut;

class ProductsModels extends BaseModel {

    function __construct()
    {
        parent::__construct('products');
    }

    function getAll(){

        $rows = $this->db->execSelect()->rows;

        return array_map(fn($row) => new ProductInfo($row), $rows);

    }

    function get( int $id ): ProductInfo | null{
        
        $res = $this->db->execCommand( 
            sql: 'SELECT * FROM `products` WHERE `id` =?',
            params: [$id]
        );

        $row = $res->rows[0] ?? null;

        return $row ? new ProductInfo($row) : null;

    }

    function delete( int $id): bool{

        $res = $this->db->execDelete(
            condition: "id = ?",
            params: [$id],
            table: 'products'
        );

        if ($res->rowsCount > 0) {


            $path = apirest::getDir()."/files/products/P". str_pad($id, 5, '0', STR_PAD_LEFT). "/";
            $imagesDelete = glob($path . "*");
            foreach($imagesDelete as $img){
                unlink($img);
            }
            rmdir(rtrim($path, "/"));
            return true;
        }

        return false;

    }

    function update( int $id, object $data ): bool{
        
        $res = $this->db->execUpdate(
            values: $data,
            condition: "id = :id",
            conditionParams: ['id' => $id],
            table: 'products'
        );

        return $res->rowsCount > 0;

    }

    function create(object $product): ?ProductInfo{
        $product->user = qiut::getUser()->id;
        $res = $this->db->execInsert($product, 'products', '*' )->rows[0] ?? null;

        return $res ? new ProductInfo($res) : null;

    }


}