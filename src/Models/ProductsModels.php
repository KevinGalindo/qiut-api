<?php

namespace Qiut\Models;

use HNova\Db\db;
use HNova\Rest\res;
use Qiut\Models\Entities\ProductInfo;
use Qiut\qiut;

class ProductsModels extends BaseModel {

    function __construct()
    {
        parent::__construct('products');
    }

    function getAll(){

        // $res = $this->db->query( 'SELECT * FROM products' );

        // return $res->rows;

    }

    function get( int $id ):?object{

        // $res = $this->db->query( 'SELECT * FROM `products` WHERE `id` =?', [$id] );

        // return $res->rows[0]?? null;
        return null;

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

    function create(object $product){
        $product->user = qiut::getUser()->id;
        $res = $this->db->execInsert($product, 'products', '*' )->rows[0] ?? null;

        return $res ? new ProductInfo($res) : null;

    }


}