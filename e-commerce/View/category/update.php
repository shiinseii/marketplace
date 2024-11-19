<?php

include(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("Invalid ID provided.");
}

$category_details = $categoryController->show($id);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category name cannot be empty";
    } else {
        $category_name = $_POST["category_name"];
    }

    if (empty($errors)) {
        $data = ['category_name' => $category_name];

        if ($categoryController->update($id, $data)) {
            header('Location: ../category.php');
            exit();
        } else {
            echo "Error";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
</head>
<body>
    <h2>Update Category</h2>
    <a href="../category.php">Back To Category List</a>
    <br><br>
    <?php if (!empty($category_details)) : ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $category_details['id']; ?>">
            <label for="category_name">Category Name: </label>
            <input type="text" name="category_name" value="<?= htmlspecialchars($category_details['category_name']); ?>" required>
            <br>
            <input type="submit" value="Update Category">
        </form>
    <?php else: ?>
        <p>Data not found</p>
    <?php endif ?>
</body>
</html>

