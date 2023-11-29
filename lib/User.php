<?php
include_once 'Session.php';
include 'Database.php';
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();

    }
    public function userRegistration($data)
    {
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = md5($data['password']);

        if($name == ''|| $username == '' || $email == ''|| $password == ''){
            $msg = "<div class = "alert alert-danger"><strong>Error !</strong> Field must note be empty</div>";
            return $msg;
        }

    }

}


?>