<?php
require(__DIR__ . '/../Config/init.php');

class Database
{
    private $host;
    private $username;
    private $password;
    private $db_name;
    private $cnn;

    public function __construct()
    {
        $this->host = DB_SERVER;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->db_name = DB_NAME;
    }

    public function getInstance()
    {
        $db = $db = "mysql:host={$this->host};dbname={$this->db_name}";

        if (!isset($this->cnn)) {
            $this->cnn = new PDO($db, $this->username, $this->password);
        }
        return $this->cnn;
    }

    public function bindParams($stmt, $params)
    {
        foreach ($params as $key => &$value) {
            $stmt->bindParam(":" . $key, $value);
        }
    }

    public function selectData($tableName, $id, $isDeleted = 0)
    {
        if (empty($id)) {
            $query = "SELECT * FROM {$tableName} WHERE isDeleted = {$isDeleted}";
            $result = $this->getInstance()->query($query);
            return $result;
        } else {
            $query =  "SELECT * FROM {$tableName} WHERE isDeleted = {$isDeleted} and id = {$id} ";
            $result =  $this->getInstance()->query($query);
            return $result;
        }
    }

    public function insertData($tableName, $fillable)
    {
        try {
            $keys = implode(', ', array_keys($fillable));
            $values = ':' . implode(', :', array_keys($fillable));
            $query = "INSERT INTO {$tableName} ({$keys}) VALUES ({$values})";
            $stmt = $this->getInstance()->prepare($query);
            $stmt->execute($fillable);
            return true;
        } catch (PDOException $e) {
            return false; // Return false on failure
        }
    }

    public function updateData($tableName, $id, $data)
    {
        try {
            $clause = '';
            foreach ($data as $key => $value) {
                $clause .= "$key = :$key, ";
            }
            $clause = rtrim($clause, ', ');
            $query = "UPDATE {$tableName} SET {$clause} WHERE id = {$id}";
            $stmt  = $this->getInstance()->prepare($query);
            $this->bindParams($stmt, $data);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return ("Error updating data: " . $e->getMessage());
        }
    }

    public function deleteRecord($tableName,  $id)
    {
        $query = "UPDATE {$tableName} SET isDeleted=1 WHERE id={$id}";
        $stmt = $this->getInstance()->prepare($query);
        $stmt->execute();
        return true;
    }

    public function restoreRecord($tableName)
    {
        $query = "UPDATE {$tableName} SET isDeleted=0 WHERE isDeleted=1";
        $stmt  = $this->getInstance()->prepare($query);
        $stmt->execute();
    }
}