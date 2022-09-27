<?php

use HNova\Rest\req;
use HNova\Rest\res;
use Qiut\Models\UsersModels;

$model = new UsersModels();
$data = req::body();

if (!$model->emailValid($data->email)){
    return res::json([
        'message' => 'El correo eletrónico ya esta en uso'
    ], 400);
}

$user = $model->create($data);
$token = $model->createToken($user->id);

return [
    'name' => $user->name,
    'email' => $user->email,
    'token' => $token
];