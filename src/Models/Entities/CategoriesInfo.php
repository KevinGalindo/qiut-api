<?php
namespace Qiut\Models\Entities;


class CategoriesInfo extends BaseEntities{
    public int $id;
    public string $name;

    public function __construct($data) {
        parent::__construct($data);
    }
}