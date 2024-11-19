<?php

require_once(__DIR__ . '/../Config/init.php');

$productController = new ProductController();
$categoryController = new CategoryController();

$products = $productController->index();

$categories = $categoryController->index();
$categoryMap = [];
foreach ($categories as $category) {
    $categoryMap[$category['id']] = $category['category_name'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
<body>
    <h2>Product List</h2>
    <a href="product/create.php">Add New Product</a>
    <br><br>

    <table>
        <tr>
            <td>No</td>
            <td>Product Name</td>
            <td>Category</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Action</td>
        </tr>
<?php if (!empty($products)):
    $counter = 1;
    foreach ($products as $product): ?>
        <tr>
            <td><?= $counter ?></td>
            <td><?= $product["product_name"] ?></td>
            <td><?= $categoryMap[$product['id_category']] ?? 'N/A' ?></td>
            <td><?= $product["price"] ?></td>
            <td><?= $product["stock"] ?></td>
            <td>
                <a href="product/detail.php?id=<?= $product["id"] ?>">View</a> | 
                <a href="product/update.php?id=<?= $product["id"] ?>">Update</a> | 
                <a href="product/delete.php?id=<?= $product["id"] ?>">Delete</a>
            </td>
        </tr>
        <?php $counter++;
    endforeach;
else: ?>
        <tr>
            <td colspan="6">0 Result</td>
        </tr>
<?php endif; ?>
    </table>
</body>
</html>