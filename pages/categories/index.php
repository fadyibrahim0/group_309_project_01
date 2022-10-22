<?php require_once '../../core/config.php'; ?>
<?php require_once PATH . 'pages/inc/header.php'; ?>
<?php require_once PATH . 'core/connection.php'; ?>
<?php if(session_status() == PHP_SESSION_NONE) session_start(); ?>

<?php

$query = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<h1 class="text-center my-5">All Categories</h1>

<a href="add.php" class="btn btn-primary my-4">Add New Category</a>

<?php require_once PATH . 'pages/inc/messages.php'; ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($categories as $category):
        ?>
        <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $category['name'] ?></td>
            <td><?= $category['description'] ?></td>
            <td>
                <a href="<?= URL . "handlers/categories/delete.php?id=" . $category['id'] ?>" class="btn btn-danger">
                    Delete
                </a>
                <a href="<?= URL . "pages/categories/edit.php?id=" . $category['id'] ?>" class="btn btn-secondary">
                    Edit
                </a>
            </td>
        </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>

<?php require_once PATH . 'pages/inc/footer.php'; ?>