<?php

include ("./models/poem_model.php");

function poemController() {
    updateAllPoems();
    if (isset($_GET["xx"]) && $_GET["xx"] == "displayPoem") {
        $_SESSION["view"] = "poemview";
    } else if (isset($_POST["xx"]) && $_POST["xx"] == "addPoem") {
        //Add a new poem
        addNewPoem($_POST["title"], $_POST["author"], $_POST["poem"]);
        updateAllPoems();
        $_SESSION['view'] = "featuredpoem";
    } else if (isset($_GET["xx"]) && $_GET["xx"] == "randomPoem") {
        $_SESSION["view"] = "randompoemview";
    } else {
        $_SESSION['view'] = "addnewpoem";
    }
}

function addNewPoem($title, $author, $poem) {
    addPoem($title, $author, $poem);
}

?>
