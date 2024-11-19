<?php

require(__DIR__. '/../../Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();

$errors = [];

$categories = $categoryController->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST["product_name"])) {
        $errors['product_name'] = "Product Name is required";
    } else {
        $product_name = $_POST["product_name"];
    }

    if (empty($_POST["id_category"])) {
        $errors['id_category'] = "Category is required";
    } else {
        $id_category = $_POST["id_category"];
    }

    // Validate price
    if (empty($_POST["price"])) {
        $errors['price'] = "Price is required";
    } else if (is_numeric($_POST["price"]) == false) {
        $errors['price'] = "Price must be a number";
    } else if (floatval($_POST["price"]) <= 0) {
        $errors['price'] = "Price should be greater than zero";
    } else {
        $price = $_POST["price"];
    }

    // Validate quantity
    if (!isset($_POST["stock"]) || empty($_POST["stock"])) {
        $errors['stock'] = "Stock is required";
    } else if (!is_numeric($_POST["stock"])) {
        $errors['stock'] = "Stock must be a valid number";
    } else if ((int)$_POST["stock"] < 0) {
        $errors['stock'] = "Stock cannot be negative";
    } else if ($_POST["stock"] != (string)(int)$_POST["stock"]) {
        $errors['stock'] = "Stock must be an integer";
    } else {
        $stock = $_POST["stock"];
    }

    if (empty($errors)) {
        $data = [
            'product_name' => $product_name,
            'id_category' => $id_category,
            'price' => $price,
            'stock' => $stock
        ];

        if ($productController->create($data)) {
            header("Location: ../product.php");
            exit();
        } else {
            echo "<script>alert('Failed to add product')</script>";
        }
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
<h2>Create Product</h2>
    <a href="../product.php">Back To Product List</a>
    <br><br>

    <form action="" method="POST">
        <label for="product_name">Product Name: </label>
        <input type="text" name="product_name" required>
        <br>
        <label for="price">Price: </label>
        <input type="text" name="price" required>
        <br>

        <label for="id_category">Category</label>
        <select name="id_category" id="" required>
        <?php foreach($categories as $category): ?>
            <option value="<?= $category['id'] ?>">
            <?= $category['category_name'] ?>
            </option>
        <?php endforeach; ?>
        </select>

        <br>
        <label for="stock">Stock: </label>
        <input type="text" name="stock" required>
        <br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>