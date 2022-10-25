<?php

use HNova\Rest\req;
use HNova\Rest\res;
use Qiut\Models\UsersModels;

$model = new UsersModels();
$data = req::body();

if (!$model->emailValid($data->email)){
    return res::json([
        'message' => 'Este correo electrónico ya se encuentra en uso'
    ], 400);
}

$user = $model->create($data);
$token = $model->createToken($user->id);

return [
    'name' => $user->name,
    'email' => $user->email,
    'token' => $token
];