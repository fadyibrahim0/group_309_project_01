<?php

require_once '../../core/connection.php';
require_once '../../core/helper.php';

session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    // Errors Array
    $errors = [];

    // Form Inputs
    $name           = trim(htmlspecialchars(htmlentities($_POST['name']))) ?? "";
    $price          = trim(htmlspecialchars(htmlentities($_POST['price']))) ?? "";
    $category_id    = $_POST['category_id'];
    $product_id     = $_POST['product_id'];

    // Task check for category if exists in our database or not also for product:

    // Product Image
    // $imgName    = $_FILES['image']['name'];
    // $imgSize    = $_FILES['image']['size'];
    // $imgType    = $_FILES['image']['type'];
    // $imgTmp     = $_FILES['image']['tmp_name'];

    // $allowedEXT = ['jpeg', 'jpg', 'png', 'gif'];

    // $explodes   = explode('.', $imgName);
    // // $imgEXT     = strtolower($explodes[count($explodes)-1]);
    // $imgEXT     = strtolower(end($explodes));
    
    // Begin Validation
    if(empty($name)) {
        $errors[] = "Product Name Is Required!";
    } elseif(strlen($name) < 3 || strlen($name) > 50) {
        $errors[] = "Product Name Should be between 3 and 50 Characters";
    }

    if(empty($price)) {
        $errors[] = "Product Price Is Required!";
    }

    // if(empty($imgName)) $errors[] = "Product Image Is Required!";
    // if(!in_array($imgEXT, $allowedEXT)) $errors[] = "This Extension isn't allowed!";
    // if($imgSize > 5242880) $errors[] = "Image Size Should be less than 5MB";

    if(empty($category_id)) $errors[] = "Category Field is Required!";
    if(empty($product_id)) $errors[] = "Product ID is Required!";
    // End Validation


    if(empty($errors)) {

        // $img = time() . '_' . $imgName;
        // move_uploaded_file($imgTmp, "../../uploads/images/products/" . $img);
        
        $query = "UPDATE `products` SET `name` = '$name', `price` = '$price', `category_id` = '$category_id' WHERE `id` = '$product_id'";
        $result = mysqli_query($conn, $query);
        $affectedRows = mysqli_affected_rows($conn);

        if($affectedRows >= 1) {
            $_SESSION['success'] = "Product Updated Successfully";
            header("Location: ../../pages/products/index.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../../pages/products/edit.php");
        exit;
    }
    

} else {
    header("Location: ../../pages/products/index.php");
    exit;
}