<?php

require(__DIR__ . '/../Config/init.php');

class Category extends Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->setTableName('categories');
    }

    public function getAllCategories()
    {
        $stmt = $this->db->selectData($this->tableName, null, 0);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id)
    {
        $stmt = $this->db->selectData($this->tableName, $id, 0);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCategory($data)
    {
        $fillable = [
            'category_name' => $data['category_name']
        ];
        return $this->db->insertData($this->tableName, $fillable);
        // return $stmt;
    }

    public function updateCategory($id, $data)
    {
        return $this->db->updateData($this->tableName, $id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreCategory()
    {
        $this->db->restoreRecord($this->tableName);
    }
}

?>