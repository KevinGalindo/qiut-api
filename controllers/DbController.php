<?php

namespace Controllers;

use HNova\Db\db;
use HNova\Rest\apirest;
use HNova\Rest\res;

class DbController {

    static function connect(){

        try {
            
            $pdo = apirest::getEnvironment()->getDatabasePDO('default');
            $dbObject = db::connect()->setPDO($pdo);
            db::setDefault($dbObject);

        } catch (\Throwable $th) {


            $json = [ 'status'=>false, 'message'=> 'Error connection' ];
            return res::json($json, 500);
            
        }

    }

}