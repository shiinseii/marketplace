<?php

require_once(__DIR__ . '/../Config/init.php');

$categoryController = new CategoryController;

$categories = $categoryController->index();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
    <h2>Category List</h2>
    <a href="category/create.php">Add Category</a>
    <br><br>

    <table>
        <tr>
            <td>No</td>
            <td>Category</td>
            <td>Action</td>
        </tr>
<?php if (count($categories) > 0):
    $counter = 1;
    foreach ($categories as $category): ?>
        <tr>
            <td><?= $counter ?></td>
            <td><?= $category["category_name"] ?></td>
            <td>
                <a href="category/detail.php?id=<?= $category["id"] ?>">View</a> | 
                <a href="category/update.php?id=<?= $category["id"] ?>">Update</a> | 
                <a href="category/delete.php?id=<?= $category["id"] ?>">Delete</a>
            </td>
        </tr>
        <?php $counter++;
    endforeach;
else: ?>
        <tr>
            <td colspan="3">0 Result</td>
        </tr>
<?php endif; ?>
    </table>
</body>
</html>