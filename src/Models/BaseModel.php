<?php
namespace Qiut\Models;

use HNova\Db\Client;

class BaseModel
{
    protected Client $db;
    function __construct(string $table = null)
    {
        $this->db = new Client();
        $this->db->setTimezone('-05:00');
        if ($table) $this->db->setDefaultTable($table);
    }
}