<?php

require_once '../../core/config.php';
require_once PATH . 'core/functions.php';
require_once PATH . 'core/connection.php';
require_once PATH . 'core/Validation.php';

session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $validationRules = [
        'name'          => ["required", "string", "max:50", "min:4"],
        'description'   => ["required", "string","min:4"],
    ];

    $validationObj = new Validation($validationRules);
    $validationObj->validate();


    if($validationObj->check()) {
        $query = "INSERT INTO `categories` (`name`, `description`)
                VALUES ('{$_REQUEST['name']}', '{$_REQUEST['description']}')";
        $result = mysqli_query($conn, $query);
        $affectedRows = mysqli_affected_rows($conn);

        if($affectedRows >= 1) {
            $_SESSION['success'] = "Category Inserted Successfully";
            redirect(URL . "pages/categories/index.php");
        }
    } else {
        $_SESSION['errors'] = $validationObj->getErrors();
        redirect(URL . "pages/categories/add.php");
    }
    

} else {
    redirect(URL . "pages/categories/index.php");
}