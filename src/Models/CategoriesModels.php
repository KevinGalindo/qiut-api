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

    function create(object $category){

        $res = $this->db->execInsert(
            values: $category,
            table: 'categories',
            returning: '*'
        )->rows[0] ?? null;

        return $res ? new CategoriesInfo($res) : null;

    }

    function delete(int $id): bool{

        $res = $this->db->execDelete(
            condition: 'id = ?',
            params: [$id],
            table: 'categories'
        );

        if ($res->rowsCount > 0) {
            return true;
        }

        return false;

    }

    function getCateName(string $name): bool{
        return $this->db->execCommand("SELECT * FROM `categories` WHERE `name` = ?", [$name])->rowsCount == 0;
    }
}