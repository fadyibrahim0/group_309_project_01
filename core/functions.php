<?php

function redirect($path)
{
    header("Location:" . $path);
    exit;
}

// Task:

// - search about how to redirect to page after time duration or a specific time in header function
// - then reimplement our redirect function with this option 