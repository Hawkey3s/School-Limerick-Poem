<?php
session_start();

require_once('./config/config.php');
require("./config/setup.php");

$controllers_available = array('main', 'poem');

if (isset($_GET['v']) && in_array($_GET['v'], $controllers_available)) {
    if ("main" == $_GET['v']) {
        $controller = "main";
    } else {
        $controller = $_GET['v'];
    }
} else {
    $controller = "main";
}

$controller();

function main() {
    require_once("./controllers/main.php");
    mainController();
    displayView($_SESSION['view']);
}

function poem() {
    require_once("./controllers/poem.php");
    poemController();
    displayView($_SESSION['view']);
}

function get_poem($item, $i) {
    $poem = $item[$i];
    $title = $poem[0];
    $author = $poem[1];
    $content = $poem[2];
    $rating = $poem[3];
    $poem_content = array($title, $author, $content, $rating);
    return $poem_content;
}

function displayView($view) {
    ?>

    <html xmlns="http://www.w3.org/1999/xhtml" >
        <head>
            <title><?php echo site; ?></title>
            <meta name="keywords" content="HW3" />
            <meta charset="utf-8" />
            <meta name="ROBOTS" content="NOINDEX"/>
        </head>
        <body>
            <?php
            global $data;
            global $dataF;
            global $dataM;
            global $dataFav;
            global $dataRandom;
            require_once("./views/{$view}.php");
            ?>
        </body>
    </html>
    <?php
}
?>
