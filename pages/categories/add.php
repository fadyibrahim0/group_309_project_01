<?php require_once '../inc/header.php'; ?>
<?php require_once '../../core/connection.php'; ?>
<?php session_start() ?>

<h1 class="text-center my-5">Add Category</h1>

<a href="index.php" class="btn btn-primary my-4">All Categories</a>

<?php require_once '../inc/messages.php'; ?>

<form method="POST" action="../../handlers/categories/store.php">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3 form-group">
                <label for="description" class="form-label">Category Description</label>
                <input type="text" name="description" class="form-control" id="description">
            </div>
            <button class="btn btn-primary" name="submit">Add</button>
        </div>
    </div>
    
</form>

<?php require_once '../inc/footer.php'; ?>