<?php
namespace Qiut\Models\Entities;

class UserInfo extends BaseEntities
{
    public int $id;
    public string $date;
    public string $name;
    public string $email;
    public string $password;
    public string|null $token;
    public string|null $tokenExp;
}