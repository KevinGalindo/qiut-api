<?php

namespace Controllers;

use HNova\Db\db;
use HNova\Rest\res;

class AccessController {

    static function isAuth(){

        $token = apache_request_headers()[ 'Access-Token' ]?? null;

        if ($token) {
            
            $db = db::getObject();
            $user = $db->query( 'SELECT * FROM `admin` WHERE `token` = ?', [$token] )
                ->rows[0]??null;

            if ($user) {
                return null;
            }
            
        }

        $json = ['status' => false, "message" => "No estas autenticado." ];

        return res::json($json, 401);

    }

}