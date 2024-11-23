<?php
$host = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbase = "admin";

    $dbc = mysqli_connect($host, $dbuser, $dbpass, $dbase)
        or die("Unable to select database");

?>