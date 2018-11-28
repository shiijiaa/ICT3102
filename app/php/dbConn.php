<?php

/*
$db_host = "47.74.157.186";
$db_username = "root";
$db_password = "!65ia24XO";
$db_name = "i16SIC024X_ICT2103_Project.Upload";
*/
$db_host = "mariadb";
$db_username = "root";
$db_password = "";
$db_name = "ict2103_3102";

//$db_password = "foobar123!";
//$db_name = "16SIC024X_ICT2103_Project";
$link = mysqli_connect($db_host, $db_username, $db_password, $db_name, 3306);

if (!$link) {
    die(mysqli_error($link));
    // alternative way to display the error:
     die(mysqli_connect_error());
}

date_default_timezone_set('Asia/Singapore');

?>