<?php

use HNova\Rest\req;
use HNova\Rest\res;
use Qiut\Models\UsersModels;

$email = req::body()->email;

$new = new UsersModels();

$user = $new->getUser($email);

if ($user) {
    
    $password = req::body()->password;

    if (password_verify($password, $user->password)) {

        $new->updatePasswordHash($user->id, $password);

        $token = $new->createToken($user->id);

        return res::json([
            "status" => true,
            "message" => "Credenciales correctas",
            "token" => $token
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