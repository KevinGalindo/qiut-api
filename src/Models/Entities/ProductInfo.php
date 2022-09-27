<?php
namespace Qiut\Models\Entities;

class ProductInfo extends BaseEntities
{
    public int $id;
    public string $date;
    public int $user;
    public string $name;
    public string $description;
    public int $price;
    public array $categories = [];
}