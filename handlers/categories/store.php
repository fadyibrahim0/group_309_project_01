<?php

require_once '../../core/connection.php';
require_once '../../core/helper.php';

session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    // Errors Array
    $errors = [];

    // Form Inputs
    $name           = htmlspecialchars(trim($_POST['name'])) ?? "";
    $description    = htmlspecialchars(trim($_POST['description'])) ?? "";

    // Begin Validation
    if(empty($name)) {
        $errors[] = "Category Name Is Required!";
    } elseif(strlen($name) < 3 || strlen($name) > 50) {
        $errors[] = "Category Name Should be between 3 and 50 Characters";
    }

    if(empty($description)) {
        $errors[] = "Category Description Is Required!";
    } elseif(strlen($name) < 3) {
        $errors[] = "Category Description Should Be Greater Than 3 Characters ";
    }
    // End Validation


    if(empty($errors)) {
        $query = "INSERT INTO `categories` (`name`, `description`)
                VALUES ('$name', '$description')";
        $result = mysqli_query($conn, $query);
        $affectedRows = mysqli_affected_rows($conn);

        if($affectedRows >= 1) {
            $_SESSION['success'] = "Category Inserted Successfully";
            header("Location: ../../pages/categories/index.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../../pages/categories/add.php");
        exit;
    }
    

} else {
    header("Location: ../../pages/categories/index.php");
    exit;
}