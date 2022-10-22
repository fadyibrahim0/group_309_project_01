<?php
$rootDirName = basename(dirname(__DIR__));

$explodes = explode("/", $_SERVER['REQUEST_URI']);

$projPath = "";
foreach($explodes as $item) {
    if($item == $rootDirName) {
        $projPath .= "$item/";
        break;
    }
    $projPath .= "$item/";
}

// Root URL (used when redirect of href)
define("URL", "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $projPath);

// FULL PATH (use when require or include files)
define("PATH", $_SERVER["DOCUMENT_ROOT"] . $projPath);


function dd($data)
{
    echo "<pre>";
        print_r($data);
    echo "</pre>";
}