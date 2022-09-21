<?php

namespace Qiut\Models;

use HNova\Db\db;
use HNova\Rest\res;

class ProductsModels {

    function __construct( private db $db = new db() )
    {
        $this->db->setTable("products");
    }

    function getAll(){

        $res = $this->db->query( 'SELECT * FROM products' );

        return $res->rows;

    }

    function get( int $id ):?object{

        $res = $this->db->query( 'SELECT * FROM `products` WHERE `id` =?', [$id] );

        return $res->rows[0]?? null;

    }

    function delete( int $id){

        $res = $this->db->delete( "id =?", [$id] );

        return $res->rowsCount > 0;

    }

    function update( int $id, object $data ):bool{

        $res = $this->db->update( $data, ['id = :id', [ 'id' => $id ]]);

        return $res->rowsCount > 0 ;

    }

    function create( object $product ){

        $res = $this->db->insert($product, 'products', '*' );

        return $res->rows[0];

    }


}