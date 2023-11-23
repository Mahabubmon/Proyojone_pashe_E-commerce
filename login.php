<?php
require_once 'config.php';
s
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="text">
            <input class="input1" id="userName" type="text" placeholder="Username" required>
            <input class="input2" id="pass" type="password" placeholder="Password" required>
            <p>Forgot Password</p>
            <input type="submit" name="" id="submitLogin" value="Login" onclick="loginForm()">
            <p>Not A Mamber? <span>register</span></p>
        </div>
    </div>

    <script src="main.js"></script>

</body>

</html>

<script>

    function loginForm() {

    }

</script>