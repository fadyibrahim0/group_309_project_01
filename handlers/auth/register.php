<?php

require_once '../../core/connection.php';
require_once '../../core/Validation.php';
require_once '../../core/helper.php';

session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $validationRules = [
        'name'          => ["required", "string", "max:50", "min:4"],
        'email'         => ["required", "email"],
        'password'      => ["required", "string"],
    ];

    $validationObj = new Validation($validationRules);
    $validationObj->validate();


    if($validationObj->check()) {
        $name       = $_REQUEST['name'];
        $email      = $_REQUEST['email'];
        $password   = sha1($_REQUEST['password']);

        $query = "INSERT INTO `users` (`name`, `email`, `password`)
                VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $query);
        $affectedRows = mysqli_affected_rows($conn);

        if($affectedRows >= 1) {
            $_SESSION['success'] = "You Are Registered Successfully";
            header("Location: ../../pages/auth/login.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $validationObj->getErrors();
        header("Location: ../../pages/auth/login.php");
        exit;
    }
    

} else {
    header("Location: ../../pages/auth/login.php");
    exit;
}