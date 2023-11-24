<?php
$sname = "localhost";
$uname = "root";
$password = "";

$dbname = "admin";

$conn = new mysqli($sname, $uname, $password, $dbname);

if (!$conn) {
    echo "Connection failed";
}



?>