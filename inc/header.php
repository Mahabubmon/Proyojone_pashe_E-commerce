<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../lib/Session.php';
Session::init();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="inc/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="inc/jquery.min.js"></script>
    <script src="inc/bootstrap.bundle.min.js"></script>
</head>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
}


?>



<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">All User Page</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <?php
                    $id = Session::get('id');
                    $userlogin = Session::get('login');
                    if ($userlogin == true) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?action=logout">Logout</a>
                        </li>
                    <?php } else { ?>


                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>