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
    public string $type;
    public array $categorys = [];
    public array $images = [];

    public function __construct($data) {
        parent::__construct($data);
        $path = "files/products/P". str_pad($this->id, 5, '0', STR_PAD_LEFT). "/";
        $arrayImgs = glob($path . "*");
        $this->images = array_map(fn($img)=>basename($img),$arrayImgs);
        // $this->images = glob($path . "*");
    }
}