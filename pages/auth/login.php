<?php require_once '../inc/header.php'; ?>
<?php require_once '../../core/connection.php'; ?>
<?php if(session_status() == PHP_SESSION_NONE) session_start(); ?>

<div class="container">
    <div class="row">
        <h1 class="text-center my-5">Login Page</h1>

        <?php require_once '../inc/messages.php'; ?>

        <form method="POST" action="../../handlers/auth/login.php" class="m-auto">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <button class="btn btn-primary" name="submit">Login</button>
                </div>
            </div>
            
        </form>
    </div>
</div>

<?php require_once '../inc/footer.php'; ?>