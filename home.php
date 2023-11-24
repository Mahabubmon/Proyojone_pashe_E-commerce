<?php
session_start();

if (isset($_SESSION["id"]) && isset($_SESSION["email"])) { ?>

    <html>

    <head>
        <title>Home</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>Hello,
            <?php echo $_SESSION['email']; ?>
        </h1>
        <a href="logout.php">Logout</a>
    </body>

    </html>
    <?php

} else {
    header("Location:index.php");
    exit();
}
?>