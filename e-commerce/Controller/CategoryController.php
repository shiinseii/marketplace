<?php

require(__DIR__ . '/../Config/init.php');

class CategoryController
{
    private $categoryModel;

    public function __construct() 
    {
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
        return $categories;
    }

    public function create($data)
    {
        try {
            return $this->categoryModel->createCategory($data);
        } catch (PDOException $err) {
            die("Error when adding category: ". $err->getMessage());
        }
    }

    public function show($id)
    {
        $categories = $this->categoryModel->getCategoryById($id);
        return !empty($categories) ? $categories[0] : null;
    }

    public function update($id, $data)
    {
        return $this->categoryModel->updateCategory($id, $data);
    }

    public function destroy($id)
    {
        return $this->categoryModel->deleteCategory($id);
    }
}

?>