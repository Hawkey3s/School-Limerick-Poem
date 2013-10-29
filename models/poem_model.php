<?php

require("./config/setup.php");

if (isset($_GET['rate']) && isset($_GET['title'])) {
    recordRate();
}

function addPoem($title, $author, $poem) {
    $text = $poem;
    $words = explode("\n", $text);
    $last = array();
    for ($i = 0; $i < count($words); $i++) {
        //echo count($words);
        $lastWord = explode(" ", $words[$i]);
        //echo $lastWord[count($lastWord)-1] . "<BR/>";
        $last[] = $lastWord[count($lastWord) - 1];
    }
    $one = substr(soundex($last[0]), 1);
    $two = substr(soundex($last[1]), 1);
    $three = substr(soundex($last[2]), 1);
    $four = substr(soundex($last[3]), 1);
    $five = substr(soundex($last[4]), 1);
    //echo $one . "<BR/>" . $two . "<BR/>" . $three . "<BR/>" . $four . "<BR/>" . $five . "<BR/>";
    if (($one === $two && $one === $five) && ($three === $four)) {

        $link = mysqli_connect("localhost", "root", "", "looney"); //Change this

        $title = mysqli_real_escape_string($link, $title);
        $author = mysqli_real_escape_string($link, $author);
        $poem = mysqli_real_escape_string($link, $poem);

        $query = "INSERT INTO poems (Title, Author, Poem) VALUES ('$title','$author','$poem')";
        $result = mysql_query($query);
    } else {
        echo "Poem to add is not Limericks, it has not been added to the database";
    }
}

function getAPoem($titleName) {
    $query = "SELECT * FROM poems WHERE Title = '$titleName'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);

    $title = $row['Title'];
    $author = $row['Author'];
    $poem = $row['Poem'];
    $rating = $row['RatingAverage'];

    $data = array($title, $author, $poem, $rating);
    return $data;
}

function getAllPoems() {
    $query = "SELECT * FROM poems";
    $result = mysql_query($query);
    $data = array();
    while ($titles = mysql_fetch_array($result)) {
        $data[] = getAPoem($titles['Title']);
    }
    return $data;
}

function getFeaturedPoem() {

    //if there's no featured poem, get one.
    $query = "SELECT * FROM featuredpoem";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 0) {
        $getPoem = "SELECT * FROM poems order by RAND()";
        $result2 = mysql_query($getPoem);
        if(mysql_num_rows($result2) == 1){
        $detail = mysql_fetch_assoc($result2);
        }
        else{
            $detail = mysql_fetch_array($result2);
        }
        $title = $detail['Title'];
        $author = $detail['Author'];
        $poem = $detail['Poem'];
        $date = $detail['Date'];

        $copy = "INSERT INTO featuredpoem (Title, Author, Poem, Date)
            VALUES ('$title','$author','$poem', NOW())";
        $result = mysql_query($copy);
    }

    //if more than 10 minutes, get a new poem
    $query2 = "SELECT * FROM featuredpoem";
    $result2 = mysql_query($query2);
    $time = mysql_fetch_array($result2);
    $lastselect = $time['Date'];
    date_default_timezone_set('America/Los_Angeles');
    /*
      echo "last select time: " . $lastselect . "<BR/>";
      echo "current time: " . date("Y-m-d H:i:s"); */

    if ((time() - strtotime($lastselect)) > 60) {
        mysql_query('TRUNCATE TABLE featuredpoem;');

        $getPoem = "SELECT * FROM poems order by RAND() LIMIT 1";
        $result2 = mysql_query($getPoem);
        $detail = mysql_fetch_array($result2);

        $title = $detail['Title'];
        $author = $detail['Author'];
        $poem = $detail['Poem'];
        $date = $detail['Date'];

        $copy = "INSERT INTO featuredpoem (Title, Author, Poem, Date)
            VALUES ('$title','$author','$poem',NOW())";
        $result = mysql_query($copy);
    }

    //get the featured poem
    $query3 = "SELECT * FROM featuredpoem";
    $result3 = mysql_query($query3);
    $dataF = array();
    $titles = mysql_fetch_array($result3);
    $dataF[] = getAFeaturedPoem($titles['Title']);
    return $dataF;
}

function getAFeaturedPoem($titleName) {
    $query = "SELECT * FROM featuredpoem WHERE Title = '$titleName'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $title = $row['Title'];
    $author = $row['Author'];
    $poem = $row['Poem'];

    $query2 = "SELECT * FROM poems WHERE Title = '$titleName'";
    $result2 = mysql_query($query2);
    $row2 = mysql_fetch_array($result2);
    $rating = $row2['RatingAverage'];

    $dataF = array($title, $author, $poem, $rating);
    return $dataF;
}

function recordRate() {

    $stars = $_GET['rate'];
    $titleN = $_GET['title'];
    $query = "SELECT * FROM poems WHERE Title = '$titleN'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);

    $currentStar = $row['Rating'] + $stars;
    $currentCount = $row['RatingCount'] + 1;
    $currentAverage = round(($currentStar / $currentCount) * 2) / 2; //round to nearest 0.5

    $replace = "UPDATE poems SET Rating = '$currentStar' WHERE Title = '$titleN'";
    $count = "UPDATE poems SET RatingCount = '$currentCount' WHERE Title = '$titleN'";
    $average = "UPDATE poems SET RatingAverage = '$currentAverage' WHERE Title = '$titleN'";
    $done = mysql_query($replace);
    mysql_query($count);
    mysql_query($average);
    if ($done) {        
    } else {
        echo "failed to update star";
    }
}

function getMostRecentPoems() {
    $poems = getAllPoems();
    $count = 0;
    $list = array();
    for ($i = count($poems) - 1; ($count < 10) && ($count < count($poems)); $i--) {
        $title = $poems[$i][0];
        $count++;
        $link = '<a href="index.php?v=poem&view=poemview&xx=displayPoem&e=' . $i . '">' . $title . '</a>';
        $list[] = $link;
    }
    return $list;
}

function getFavoritePoems() {
    $poems = getAllPoems();

    $query = "SELECT * From poems ORDER BY RatingAverage DESC LIMIT 10";
    $result = mysql_query($query);
    $list = array();
    while ($poem = mysql_fetch_array($result)) {
        $i = 0;
        for ($j = 0; $j < count($poems); $j++) {
            if ($poem['Title'] == $poems[$j][0]) {
                $i = $j;
            }
        }
        $link = '<a href="index.php?v=poem&view=poemview&xx=displayPoem&e=' . $i . '">' . $poem['Title'] . '</a>';
        $list[] = $link;
    }
    return $list;
}

function getRandomPoem() {
    $query = "SELECT * FROM poems ORDER BY RAND() LIMIT 1";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $title = $row['Title'];

    $data = array(getAPoem($title));
    return $data;
}
?>
