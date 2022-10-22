<?php if(session_status() == PHP_SESSION_NONE) session_start(); ?>

<?php
$rootDirName = basename(dirname(dirname(__DIR__)));

$explodes = explode("/", $_SERVER['REQUEST_URI']);

$projPath = "";
foreach($explodes as $item) {
    if($item == $rootDirName) {
        $projPath .= "$item/";
        break;
    }
    $projPath .= "$item/";
}

// Nav URL
define("N_URL", "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $projPath);
?>


<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Project1</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= N_URL . 'pages/index.php' ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= N_URL . 'pages/categories/index.php' ?>">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= N_URL . 'pages/products/index.php' ?>">Products</a>
                </li>
                
            </ul>
            <?php
                if(isset($_SESSION['logged'])) {
                ?>
                <ul class="navbar-nav mx-5 mb-2 mb-lg-0 justify-content-right">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"><?= $_SESSION['logged']['name'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../handlers/auth/logout.php">Logout</a>
                    </li>
                </ul>
                <?php
                }
                ?>
        </div>
    </div>
</nav>