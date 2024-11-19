<?php

include(__DIR__ . '/../../Config/init.php');

$id = $_GET['id'];

$categoryController = new CategoryController();

$categories = $categoryController->show($id);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Detail</title>
</head>
<body>
<h2>Category Details</h2>
    <a href="../category.php">Back To Category List</a>
    <br><br>

    
<?php if (!empty($categories)) : ?>
    <table>
        <tr>
            <td>Id  </td>
            <td>: <?= $categories['id'] ?></td>
        </tr>
        <tr>
            <td>Category Name  </td>
            <td>: <?= $categories['category_name'] ?></td>
        </tr>
    </table>
<?php else: ?>
    <p>0 Result</p>
<?php endif ?>
</body>
</html>
