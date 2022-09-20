<?php

namespace Controllers;

use HNova\Db\db;
use HNova\Rest\req;
use HNova\Rest\res;
use Qiut\Models\UsersModels;

class AccessController {

    static function auth(){

        $email = req::body()->email;

        $new = new UsersModels();

        $user = $new->getUser($email);

        if ($user) {
            
            $password = req::body()->password;

            if ($user->password == $password) {
                return res::json([
                    "status" => true,
                    "message" => "Credenciales correcatas"
                ], 200);
            }

            return res::json([
                "status" => false,
                "message" => "Contraseña incorrecta"
            ], 401);

        }

        return res::json([
            "status" => false,
            "message" => "Correo erroneo"
        ], 401);

    }

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