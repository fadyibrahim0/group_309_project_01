<?php require_once '../inc/header.php'; ?>
<?php require_once '../../core/connection.php'; ?>
<?php session_start(); ?>

<?php

$query = "SELECT * FROM `products`";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<h1 class="text-center my-5">All Products</h1>

<a href="add.php" class="btn btn-primary my-4">Add New Product</a>

<?php require_once '../inc/messages.php'; ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($products as $product):
        ?>
        <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $product['name'] ?></td>
            <td>
                <img src="../../uploads/images/products/<?= $product['image'] ?>" alt="Image" style="width:70px; height:70px; border-radius: 50%;" />
            </td>
            <td><?= $product['price'] ?></td>
            <td>
                <a href="../../handlers/products/delete.php?id=<?= $product['id'] ?>" class="btn btn-danger">
                    Delete
                </a>
                <a href="edit.php?id=<?= $product['id'] ?>" class="btn btn-secondary">
                    Edit
                </a>
            </td>
        </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>

<?php require_once '../inc/footer.php'; ?>