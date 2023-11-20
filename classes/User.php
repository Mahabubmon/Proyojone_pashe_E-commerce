<?php
class User extends Basic
{

    private $dbConnection;
    function __construct($db)
    {
        $this->dbConnection = $db;
    }
    public function validation($fname, $lname, $userName, $email, $password, $passwordConfirm)
    {
        $fname = $this->sanitize($fname, 'string');
        $lname = $this->sanitize($lname, 'string');
        $userName = $this->sanitize($userName, 'string');
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

        if (strlen($userName) <= 2) {
            $error[] = 'Please enter userName using 3 charaters atleast.';
        }
        if (strlen($userName) > 2) {
            if (!preg_match("/^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/", $userName)) {
                $error[] = 'Invalid Entry for userName.Eg - myuserName or myuserName123';
            }
        }
        if (strlen($userName) > 20) {
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
        $sql = "SELECT count(*) from users WHERE userName:userName";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $stmt->execute();
        $count_username = $stmt->fetchColumn();
        if ($count_username > 0) {
            $error[] = 'Username already exits';
        }
        $sql = "SELECT count(*) from users WHERE userName:userName";
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
        $stmt->execute();
        $count_username = $stmt->fetchColumn();
        if ($count_username > 0) {
            $error[] = 'Username already exits';
        }
    }
}
?>