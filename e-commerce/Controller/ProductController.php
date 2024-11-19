<?php

require(__DIR__. '/../Config/init.php');


class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();   
    }

    public function index()
    {
        $products = $this->productModel->getAllProduct();
        return $products;
    }

    public function create($data)
    {
        try {
            return $this->productModel->createProduct($data);
        } catch (PDOException $err) {
            die("Error when adding product: ". $err->getMessage());
        }
    }

    public function show($id)
    {
        $products = $this->productModel->getProductById($id);
        return !empty($products) ? $products[0] : null;
    }

    public function update($id, $data)
    {
        return $this->productModel->updateProduct($id, $data);
    }

    public function destroy($id)
    {
        return $this->productModel->deleteProduct($id);
    }
}