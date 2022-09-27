<?php

namespace Qiut\Models;
use Qiut\Models\Entities\UserInfo;

class UsersModels extends BaseModel {

    function __construct()
    {
        parent::__construct('admin');
    }

    public function getUser( string $email ):?UserInfo{
        
        $user = $this->db->execCommand('SELECT * FROM `admin` WHERE `email` = ?', [$email] )->rows[0] ?? null;

        return $user ? new UserInfo($user) : null;
    }

    /**
     * @return UserInfo[]
     */
    public function getUsersAll():array {
        $rows = $this->db->execSelect()->rows;
        return array_map(fn($row) => new UserInfo($row), $rows);
    }

    public function createToken( int $id ):string{

        $token = bin2hex(random_bytes((50 - (50 % 2)) / 2));
        $date_exp = date("Y-m-d",strtotime(date("Y-m-d")."+ 1 day"));

        $this->db->execUpdate(
            values: ['token' => $token , 'tokenExp' => $date_exp],
            condition: 'id = ?',
            conditionParams : [$id]
        );

        return $token;

    }

    public function updatePasswordHash(int $id, string $password):void {
        $password = password_hash($password, PASSWORD_DEFAULT, ['cos' => 3]);
        $this->db->execUpdate(['password' => $password], 'id = ?', [$id]);
    }

    function create(object $user):UserInfo{
        $user->password = password_hash($user->password, PASSWORD_DEFAULT, ['cos' => 3]);
        $res = $this->db->execInsert($user, 'admin', '*')->rows[0];
        return new UserInfo($res);
    }

    function emailValid(string $email):bool {

        // return $this->db->execSelect(condition: 'email = ?', params: [$email])->rowsCount == 0;

        return $this->db->execCommand("SELECT * FROM `admin` WHERE `email` = ?", [$email])->rowsCount == 0;
    }

    function getUserByToken(string $token):?UserInfo{

        $obj = $this->db->execCommand("SELECT * FROM `admin` WHERE `token` = ? AND (`tokenExp` > NOW() || `tokenExp` is null)", [$token])->rows[0] ?? null;

        return $obj ? new UserInfo($obj) : null;
    }

}