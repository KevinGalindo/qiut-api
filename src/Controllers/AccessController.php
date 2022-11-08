<?php

namespace Qiut\Controllers;

use HNova\Rest\res;
use LengthException;
use Qiut\Models\UsersModels;

class AccessController {

    static function auth(){
        return require __DIR__ . '/scripts/acess/auth.php';
    }

    static function signUp(){
       return require __DIR__ . '/scripts/acess/sign-up.php';
    }

    static function isAuth(){

        $token = apache_request_headers()[ 'access-token' ] ?? (apache_request_headers()[ 'Access-Token' ] ?? null);

        if ($token) {
            $model = new UsersModels();
            $user = $model->getUserByToken($token);

            if ($user){

                $_ENV['qiut']['user'] = $user;

                return null;
            }
        }

        $json = ['status' => false, "message" => "No estas autenticado." ];

        return res::json($json, 401);

    }

    static function userAll(){
        $model = new UsersModels();

        $cout = $model->getUsersAll();

        return $cout;
    }

    static function logout(){

        $token = apache_request_headers()[ 'Access-Token' ]?? null;

        if ($token) {
            $model = new UsersModels();
            $user = $model->getUserByToken($token);

            if ($user) {

                $model = new UsersModels();
                $model->breakToken($user->id);
    
                $json = ['status' => true, "message" => "Sea cerrado seccion correctamente"];

                return res::json($json, 200);
            }
        }

        $json = ['status' => false, "message" => "No estas autenticado"];

        return res::json($json, 401);

    }

}