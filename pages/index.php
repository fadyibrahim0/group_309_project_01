<?php require_once 'inc/header.php'; ?>
<?php require_once '../core/connection.php'; ?>
<?php require_once '../core/helper.php'; ?>
<?php if(session_status() == PHP_SESSION_NONE) session_start(); ?>

<?php 
$query = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $query);
$catsNumber = mysqli_num_rows($result);
?>

<h1 class="text-center my-5">Home Page</h1>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Number of categories</h5>
        <p class="card-text"><?= $catsNumber ?></p>
    </div>
</div>

<?php require_once 'inc/messages.php'; ?>

<?php require_once 'inc/footer.php'; ?>