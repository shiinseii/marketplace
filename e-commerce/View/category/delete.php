<?php

require_once(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$category_details;

$id = $_GET['id'];

$category_details = $categoryController->show($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($categoryController->destroy($id)) {
        header('Location: ../category.php');
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
    <title>Delete Category</title>
</head>
<body>
    <h2>Delete Category</h2>
    <a href="../category.php">Back To Category List</a>
    <br><br>

<?php if (!empty($category_details)) : ?>
    <p>Are you sure you want to delete the following category?</p>
    <table>
        <tr>
            <td>Id </td>
            <td>: <?= $category_details["id"]; ?></td>
        </tr>
        <tr>
            <td>Category Name </td>
            <td>: <?= $category_details["category_name"]; ?></td>
        </tr>
    </table>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($category_details['id']); ?>">
        <input type="submit" value="Delete Category">
    </form>
<?php else: ?>
    <p>Data not found</p>
<?php endif; ?>
</body>
</html>