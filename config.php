<?php
define("DBNAME", "admin");
define("DBUSER", "root");
define("DBPASS", "");
define("DBHOST", "localhost");

try {
    $db = 'mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';utf8';
    $db = new PDO($db, DBUSER, DBPASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    // echo "Your page is connected with database successfully...";
} catch (PDOException $e) {
    echo "Issue-> Connection failed" . $e->getMessage();
}


?>