<?php

include(__DIR__ . '/../../Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();

$id = $_GET['id'];

$product_details = $productController->show($id);

$categories = $categoryController->index();
$categoryMap = [];
foreach ($categories as $category) {
    $categoryMap[$category['id']] = $category['category_name'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        if ($productController->update($id, $data)) {
            header("Location: ../product.php");
            exit();
        } else {
            echo "<script>alert('Failed to update product')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
<h2>Update Category</h2>
    <a href="../category.php">Back To Category List</a>
    <br><br>

<?php if (!empty($product_details)) : ?>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $product_details['id']; ?>">
        <label for="product_name">Product Name :</label>
        <input type="text" name="product_name" value="<?= $product_details['product_name'] ?>" required>
        <br>
        <label for="product_name">Category :</label>

        <select name="id_category" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>" <?php if ($category['id'] === $product_details['id_category']) echo 'selected' ?>>
                <?= $category['category_name'] ?>
            </option>
        <?php endforeach ?>
        </select>

        <br>
        <label for="price">Price :</label>
        <input type="text" name="price" value="<?= $product_details['price'] ?>" required>
        <br>
        <label for="stock">Stock :</label>
        <input type="text" name="stock" value="<?= $product_details['stock'] ?>" required>
        <br>
        <input type="submit" value="Update Product">
    </form>
    <?php else: ?>
        <p>Data not found</p>
    <?php endif ?>
</body>
</html>