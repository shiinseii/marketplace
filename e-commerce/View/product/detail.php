<?php

include(__DIR__ . '/../../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();
$categoryController = new CategoryController();

$products = $productController->show($id);

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
    <title>Detail Product</title>
</head>
<body>
    <h2>Product Details</h2>
    <a href="../product.php">Back To Product List</a>
    <br><br>

<?php if (!empty($products)) : ?>
    <table>
        <tr>
            <td>Id  </td>
            <td>: <?= $products["id"] ?></td>
        </tr>
        <tr>
            <td>Product Name  </td>
            <td>: <?= $products["product_name"] ?></td>
        </tr>
        <tr>
            <td>Category  </td>
            <td>: <?= $categoryMap[$products['id_category']] ?? 'N/A' ?></td>
        </tr>
        <tr>
            <td>Price  </td>
            <td>: <?= $products["price"] ?></td>
        </tr>
        <tr>
            <td>Stock  </td>
            <td>: <?= $products["stock"] ?></td>
        </tr>
    </table>
<?php else: ?>
    <p>Data not found</p>
<?php endif ?>
</body>
</html>