<?php
namespace Qiut\Models\Entities;

class BaseEntities
{
    public function __construct(object $data){
        foreach ($data as $key => $val){
            $this->$key = $val;
        }
    }
}