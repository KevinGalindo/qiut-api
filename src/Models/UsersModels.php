<?php

namespace Qiut\Models;

use HNova\Db\db;

class UsersModels {

    function __construct( private db $db = new db() )
    {
        
        $this->db->setTable('admin');

    }

    public function getUser( string $email ):?object{
        
        $user = $this->db->query('SELECT * FROM `admin` WHERE `email` = ?', [$email] )->rows[0]??null;

        return $user;

    }

    public function createToken( int $id ){

        $token = bin2hex(random_bytes((50 - (50 % 2)) / 2));

        $this->db->update( ['token' => $token],['id = :id',['id' => $id]] );

        return $token;

    }

    function create(object $user){

        // $data = json;

        $res = $this->db->insert($user, 'admin', '*');

        return $res->rows[0];

    }

}