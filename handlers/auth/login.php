<?php

require_once '../../core/connection.php';
require_once '../../core/Validation.php';
require_once '../../core/helper.php';

session_start();

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $validationRules = [
        'email'         => ["required", "email"],
        'password'      => ["required", "string"],
    ];

    $validationObj = new Validation($validationRules);
    $validationObj->validate();


    if($validationObj->check()) {
        // $name       = $_REQUEST['name'];
        $email      = $_REQUEST['email'];
        $password   = sha1($_REQUEST['password']);

        $query      = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
        $result     = mysqli_query($conn, $query);
        $user       = mysqli_fetch_assoc($result);
        $numRows    = mysqli_num_rows($result);

        if($numRows == 1) {
            $_SESSION['logged'] = $user;
            header("Location: ../../pages/index.php");
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