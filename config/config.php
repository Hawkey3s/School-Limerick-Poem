<?php
define ("site", "Looney Limericks");

function updateAllPoems()
{
    global $data;
    global $dataF;
    global $dataM;
    global $dataFav;
    global $dataRandom;
    $data = getAllPoems();
    $dataF = getFeaturedPoem();
    $dataM = getMostRecentPoems();
    $dataFav = getFavoritePoems();
    $dataRandom = getRandomPoem();
}

?>

