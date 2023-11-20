<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div class="form_container">
                    <img src="image/needIndeed.png" class="logo img-fluid" alt=""><br>
                    <form action="" method="post">
                        <div class="row">

                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="fname" class="form-control" id="fname" placeholder="First Name" value="<?php if (isset($error)) {
                                        echo $fname;
                                    } ?>">
                                    <label for="floatingInput">First Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="lname" class="form-control" id="lname" placeholder="Last Name" value="<?php if (isset($error)) {
                                        echo $lname;
                                    } ?>">
                                    <label for="floatingInput">Last Name</label>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="userName" class="form-control" id="userName"
                                        placeholder="name@example.com" value="<?php if (isset($error)) {
                                            echo $userName;
                                        } ?>">
                                    <label for="floatingInput">User Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" value="<?php if (isset($error)) {
                                            echo $email;
                                        } ?>">
                                    <label for="floatingInput">Email address</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass" placeholder="Password">
                                    <label for="floatingInput">Password</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="conPass"
                                        placeholder="Confirm Password">
                                    <label for="floatingInput">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4"> </div>
                            <div class="col-sm-4" style="text-align: center;">
                                <button type="submit" class="btn form_btn btn-primary"
                                    name="submit_form">Signup</button>

                            </div>
                            <div class="col-sm-4"> </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>



    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>