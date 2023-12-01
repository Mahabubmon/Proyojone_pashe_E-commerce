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
        $chk_email = $this->emailCheck($email);

        if ($name == '' || $username == '' || $email == '' || $password == '') {
            $msg = "<div class = 'alert alert-danger'><strong>Error !</strong> Field must note be empty</div>";
            return $msg;
        }
        if (strlen($username) < 3) {
            $msg = "<div class = 'alert alert-danger'><strong>Error !</strong> User Name is too short</div>";
            return $msg;
        } elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
            $msg = "<div class = 'alert alert-danger'><strong>Error !</strong> User Name must only content 
         alphanumerical,dashes and underscoress</div>";
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = "<div class = 'alert alert-danger'><strong>Error !</strong> The Email Address is Not Valid</div>";
            return $msg;
        }
        if ($chk_email == true) {
            $msg = "<div class = 'alert alert-danger'><strong>Error !</strong> The Email Address already Exist </div>";
            return $msg;
        }
        $sql = "INSERT ";
    }
    public function emailCheck($email)
    {
        $sql = "SELECT email FROM tbl_user WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}


?>