<?php

class Model
{
    protected $db;
    protected $tableName;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }
}

?>