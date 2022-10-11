<?php
namespace Qiut;

use Exception;
use Qiut\Models\Entities\UserInfo;

class qiut
{
    /**
        * Retorna la informacion del user que se autentique y se solicita en la peticiones
    */
    static function getUser():UserInfo{
        try {
            return $_ENV['qiut']['user'];
        } catch (\Throwable $th) {
            throw new Exception("Esta mal la variable de entoreno quit");
        }
    }
}