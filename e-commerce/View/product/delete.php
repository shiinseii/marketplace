<?php

require_once(__DIR__. '/../../Config/init.php');

$productController = new ProductController();

$id = $_GET['id'];

$product_details = $productController->show($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($productController->destroy($id)) {
        header('Location: ../product.php');
        exit();
    } else {
        echo "Error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
<h2>Delete Product</h2>
    <a href="../product.php">Back To Product List</a>
    <br><br>

<?php if (count($product_details) > 0): ?>
    <p>Are you sure to delete this product?</p>
    <table>
        <tr>
            <td>Id </td>
            <td>: <?= $product_details["id"]; ?></td>
        </tr>
        <tr>
            <td>Product Name </td>
            <td>: <?= $product_details["product_name"]; ?></td>
        </tr>
    </table>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $product_details['id']; ?>">
        <input type="submit" value="Delete Product">
    </form>
<?php else: ?>
    <p>Data Not Found</p>
<?php endif ?>
</body>
</html>