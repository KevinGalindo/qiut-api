<?php

namespace Qiut\Models;

use Qiut\Models\Entities\CategoriesInfo;

class CategoriesModels extends BaseModel{
    function __construct()
    {
        parent::__construct('categories');
    }

    function getAll(){

        $rows = $this->db->execSelect(
            fields: "*",
            table: "categories"
        )->rows;

        return array_map(fn($row) => new CategoriesInfo($row), $rows);
    }
}