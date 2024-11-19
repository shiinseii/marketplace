<?php

require(__DIR__ . '/../Config/init.php');

class Product extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('products');
    }

    public function getAllProduct()
    {
        $stmt = $this->db->selectData($this->tableName, null, 0);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $stmt = $this->db->selectData($this->tableName, $id, 0);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($data)
    {
        $fillable = [
            'product_name' => $data['product_name'],
            'id_category' => $data['id_category'],
            'price' => $data['price'],
            'stock' => $data['stock']
        ];
        return $this->db->insertData($this->tableName, $fillable);
    }

    public function updateProduct($id, $data)
    {
        return $this->db->updateData($this->tableName, $id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreProduct()
    {
        $this->db->restoreRecord($this->tableName);
    }
}

?>