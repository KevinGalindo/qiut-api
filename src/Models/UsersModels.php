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

}