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
        $fname=$this
    }
}
?>