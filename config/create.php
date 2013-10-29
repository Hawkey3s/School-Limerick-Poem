<?php

$con = mysql_connect("localhost", "root", ""); // change this to match your server info
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
//create database
$sql = 'CREATE Database looney';
$createdb = mysql_query($sql, $con);
if (!$createdb) {
    die('Could not create database: ' . mysql_error());
} else {
    //create table
    $sql = "CREATE TABLE poems(Title varchar(30), PRIMARY KEY(Title),Author varchar(30),Poem text,
        Rating double,RatingCount int,RatingAverage double,Date timestamp)";
    $sql2 = "CREATE TABLE featuredpoem(Title varchar(30), PRIMARY KEY(Title),Author varchar(30),Poem text,
        Date timestamp)";

    mysql_select_db('looney');
    $createtable = mysql_query($sql, $con);
    $createtable2 = mysql_query($sql2, $con);
    if (!$createtable || !$createtable2) {
        die('Could not create table: ' . mysql_error());
    }
    echo "Tables have been created!";
    
}
mysql_close($con);
?>
