<?php

namespace Qiut\Models;

use HNova\Db\db;

class ProductsModels {

    function __construct( private db $db = new db() )
    {
        
    }

    function getAll(){

        $res = $this->db->query( 'SELECT * FROM products' );

        return $res->rows;

    }

    function create( object $product ){

        $res = $this->db->insert($product, 'products', '*' );

        return $res->rows[0];

    }


}