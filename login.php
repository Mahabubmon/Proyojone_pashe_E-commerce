<?php
session_start();
include "config.php";

if (isset($_POST["userName"]) && $_POST["password"]) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$userName = validate($_POST["userName"]);
$pass = validate($_POST["pasword"]);


if (empty($userName)) {
    hearder("Location: index.php?erro=User Name is required");
}


?>