<?php

namespace Qiut\Models;

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

    function get( int $id ):?object{
        
        $res = $this->db->execCommand( 
            sql: 'SELECT * FROM `products` WHERE `id` =?',
            params: [$id]
        );

        $row = $res->rows[0] ?? null;

        return new ProductInfo($row);

    }

    function delete( int $id){

        // $res = $this->db->delete( "id =?", [$id] );

        // return $res->rowsCount > 0;

    }

    function update( int $id, object $data ):bool{
        return false;
        // $res = $this->db->update( $data, ['id = :id', [ 'id' => $id ]]);

        // return $res->rowsCount > 0 ;

    }

    function create(object $product): ?ProductInfo{
        $product->user = qiut::getUser()->id;
        $res = $this->db->execInsert($product, 'products', '*' )->rows[0] ?? null;

        return $res ? new ProductInfo($res) : null;

    }


}