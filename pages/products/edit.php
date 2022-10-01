<?php require_once '../inc/header.php'; ?>
<?php require_once '../../core/connection.php'; ?>
<?php require_once '../../core/helper.php'; ?>
<?php session_start() ?>

<h1 class="text-center my-5">Edit Product</h1>

<a href="index.php" class="btn btn-primary my-4">All Product</a>

<?php require_once '../inc/messages.php'; ?>

<?php
$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = '$id'"));
$categories = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `categories`"), MYSQLI_ASSOC);
?>

<form method="POST" action="../../handlers/products/update.php">
    <input type="hidden" name="product_id" value="<?= $id ?>" />
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= $product['name'] ?>">
            </div>
            <div class="mb-3 form-group">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" name="price" class="form-control" id="price" value="<?= $product['price'] ?>">
            </div>
            <!-- <div class="mb-3 form-group">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div> -->
            <div class="mb-3 form-group">
                <label for="category_id" class="form-label">Assign Category</label>
                <select name="category_id" class="form-control">
                    <option>---</option>
                    <?php
                    foreach($categories as $category) {
                    ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category_id']) ? "selected" : ""; ?>> <?= $category['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary" name="submit">Update</button>
        </div>
    </div>
    
</form>

<?php require_once '../inc/footer.php'; ?>