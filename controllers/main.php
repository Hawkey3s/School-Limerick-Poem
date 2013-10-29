<?php

$data;//global variable $data
include("./models/poem_model.php");

/**
 * mainController reads data from entries folder then processes the data
 *
 */
function mainController()
{
    global $data;
    global $dataF;
    updateAllPoems();
    $_SESSION["view"] = "featuredpoem";
    
}