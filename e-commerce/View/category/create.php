<?php

require(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST["category_name"])) {
        $errors['category_name'] = "Category name is Required";
    } else {
        $category_name = $_POST["category_name"];
    }

    if (empty($errors)) {
        $data = ['category_name' => $category_name];

        if ($categoryController->create($data)) {
            echo "<script>alert('Category Added Successfully')</script>";
            header("Location: ../category.php");
            exit();
        } else {
            echo "<script>alert('Failed to add category')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
</head>
<body>
    <h2>Create Category</h2>
    <br><br>

    <form method="POST">
        <label for="category_name">Category</label>
        <input type="text" name="category_name" required>
        <br>
        <input type="submit" value="Add Category">
    </form>
</body>
</html>