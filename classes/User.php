<?php class User extends Basic
{
    private $dbConnection;
    function __construct($db)
    {
        $this->dbConnection = $db;
    }
    //register 
    public function validation($fname, $lname, $username, $email, $password, $passwordConfirm)
    {
        $fname = $this->sanitize($fname, 'string');
        $lname = $this->sanitize($lname, 'string');
        $username = $this->sanitize($username, 'string');
        $email = $this->sanitize($email, 'email');
        $password = $this->sanitize($password, 'string');
        $passwordConfirm = $this->sanitize($passwordConfirm, 'string');
        if (strlen($fname) <= 2) {
            $error[] = 'Please enter First name using 3 charaters atleast.';
        }
        if (strlen($fname) > 2) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
                $error[] = 'First Name:Characters Only (No digits or special charaters) ';
            }
        }
        if (strlen($fname) > 20) {
            $error[] = 'First Name: Max length 20 Characters Not allowed';
        }
        if (strlen($lname) <= 2) {
            $error[] = 'Please enter Last name using 3 charaters atleast.';
        }
        if (strlen($lname) > 2) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
                $error[] = 'Last Name:Characters Only (No digits or special charaters) ';
            }
        }
        if (strlen($lname) > 20) {
            $error[] = 'Last Name: Max length 20 Characters Not allowed';
        }

        if (strlen($username) <= 2) {
            $error[] = 'Please enter Username using 3 charaters atleast.';
        }
        if (strlen($username) > 2) {
            if (!preg_match("/^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/", $username)) {
                $error[] = 'Invalid Entry for Username.Eg - myusername or myusername123';
            }
        }
        if (strlen($username) > 20) {
            $error[] = 'UserName: Max length 20 Not allowed';
        }


        if ($email == '') {
            $error[] = 'Please enter the email address.';
        }
        if ($email != '') {
            if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)) {
                $error[] = 'Invalid Entry for Email.ie- username@domain.com';
            }
        }
        $count_username = $sql = "SELECT count(*) FROM users WHERE username=:username";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $count_username = $stmt->fetchColumn();
        if ($count_username > 0) {
            $error[] = 'Username  already exists.';
        }
        $count_username = $sql = "SELECT count(*) FROM users WHERE email=:email";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $count_email = $stmt->fetchColumn();
        if ($count_email > 0) {
            $error[] = 'Email  already exists.';
        }

        if ($password == '') {
            $error[] = 'Please enter the password.';
        }
        if ($password != '') {
            if ($passwordConfirm == '') {
                $error[] = 'Please confirm the password.';
            }
            if (strlen($password) < 6) {
                $error[] = 'The password should be 6 characters long.';
            }
            if (strlen($password) > 20) {
                $error[] = 'Password: Max length 20 Characters Not allowed';
            }
            if ($password != $passwordConfirm) {
                $error[] = 'Passwords do not match.';
            }
        }


        if (isset($error)) {
            return $error;
        } else {
            return $arrayName = [];
        }

    }
    public function register($fname, $lname, $username, $email, $password)
    {
        $fname = $this->sanitize($fname, 'string');
        $fname = $this->sanitize($fname, 'string');
        $username = $this->sanitize($username, 'string');
        $email = $this->sanitize($email, 'email');
        $password = $this->sanitize($password, 'string');
        $sql = "INSERT INTO users(fname,lname,username,email,password,created_date) VALUES(:fname,:lname,:username,:email,:password,:created_date)";
        $stmt = $this->dbConnection->prepare($sql);
        $created_date = $this->get_date();
        $options = array("cost" => 4);
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedpassword, PDO::PARAM_STR);
        $stmt->bindParam(':created_date', $created_date, PDO::PARAM_STR);
        $res = $stmt->execute();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    // login functions here

    //account function here

}
?>