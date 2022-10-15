<?php require_once '../inc/header.php'; ?>
<?php require_once '../../core/connection.php'; ?>
<?php session_start() ?>

<h1 class="text-center my-5">Register</h1>

<?php require_once '../inc/messages.php'; ?>

<form method="POST" action="../../handlers/auth/register.php">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3 form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3 form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button class="btn btn-primary" name="submit">Register</button>
        </div>
    </div>
    
</form>

<?php require_once '../inc/footer.php'; ?>