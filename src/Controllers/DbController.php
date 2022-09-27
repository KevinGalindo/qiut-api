<?php

namespace Qiut\Controllers;

use HNova\Db\Client;
use HNova\Db\db;
use HNova\Rest\apirest;
use HNova\Rest\res;

class DbController {

    static function connect(){

        try {
            
            $pdo = apirest::getEnvironment()->getDatabasePDO();
            $client = new Client($pdo);
            db::setDefault($client);

        } catch (\Throwable $th) {


            $json = [ 'status'=>false, 'message'=> 'Error connection' ];
            return res::json($json, 500);
            
        }

    }

}