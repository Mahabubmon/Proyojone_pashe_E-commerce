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
    header("Location: index.php?error=User Name is required");
    exit();
} else if (empty($pass)) {
    header("Location: index.php?error=Password Is Required");
    exit();
}

$sql = "SELECT * FROM login WHERE email= '$userName' AND passwore='pass'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row[""] == $userName && $row['password'] === $pass) {

        echo "Logged In!";
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();
    } else {
        header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>