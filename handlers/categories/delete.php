<?php 

require_once '../../core/connection.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {

    $id = $_GET['id'];

    // check here if category is already exist or not (task)

    $query = "DELETE FROM `categories` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if($result) {
        $_SESSION['success'] = "Category Deleted Successfully";
        header("Location: ../../pages/categories/index.php");
        exit;
    } else {
        header("Location: ../../pages/categories/index.php");
        exit;
    }

} else {
    header("Location: ../../pages/categories/index.php");
    exit;
}