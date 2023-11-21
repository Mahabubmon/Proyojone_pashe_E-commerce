<?php require_once("autoload.php");
if ($getUser->is_loggedin()) {
    header("location:account.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup - Techno Smarter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div class="form_container">
                    <img src="https://technosmarter.com/assets/images/logo.png" alt="Techno Smarter"
                        class="logo img-fluid"> <br>
                    <?php
                    if (isset($_POST['submit_form'])) {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $passwordConfirm = $_POST['passwordConfirm'];
                        $error = $getUser->validation($fname, $lname, $username, $email, $password, $passwordConfirm);
                        if ($error == NULL) {
                            $result = $getUser->register($fname, $lname, $username, $email, $password);
                            if ($result) {
                                header("location:login.php?register=1");
                            } else {
                                $error[] = 'Something went wrong..';
                            }
                        }

                        if (isset($error)) {
                            foreach ($error as $err) {
                                echo '<p class="errormsg">' . $err . '</p>';
                            }
                        }
                    }

                    ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="fname" id="floatingInput"
                                        placeholder="First Name" value="<?php if (isset($error)) {
                                            echo $fname;
                                        } ?>">
                                    <label for="floatingInput">First Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="lname" id="floatingInput"
                                        placeholder="Last Name" value="<?php if (isset($error)) {
                                            echo $lname;
                                        } ?>">
                                    <label for="floatingInput">Last Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="username" id="floatingInput"
                                        placeholder="Username" value="<?php if (isset($error)) {
                                            echo $username;
                                        } ?>">
                                    <label for="floatingInput">Username</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="email" id="floatingInput"
                                        placeholder="Email" value="<?php if (isset($error)) {
                                            echo $email;
                                        } ?>">
                                    <label for="floatingInput">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" id="floatingInput"
                                        placeholder="Password">
                                    <label for="floatingInput">Password </label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="passwordConfirm"
                                        id="floatingInput" placeholder="Confirm Password">
                                    <label for="floatingInput">Confirm Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4"> </div>
                            <div class="col-sm-4" style="text-align: center;"><button type="submit"
                                    class="btn form_btn btn-primary" name="submit_form">Signup>></button></div>
                            <div class="col-sm-4"> </div>
                        </div>
                    </form>
                    <br>
                    <p>Have an account? <a href="login.php">Log in </a> </p>
                </div>
            </div>

            <div class="col-sm-2">
            </div>
        </div>

    </div>
</body>

</html>