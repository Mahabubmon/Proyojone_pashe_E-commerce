<?php include 'inc/header.php';
include 'lib/User.php';
Session::checkSession();
$user = new User();
?>


<?php
$logginmsg = Session::get("loginmsg");
if (isset($logginmsg)) {
    echo $logginmsg;
}
Session::set("loginmsg", NULL);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="d-flex justify-content-between align-items-center">
            <h3>User List <span class="float-right"><strong>Welcome!</strong>

                    <?php
                    $name = Session::get("username");
                    if (isset($name)) {
                        echo $name;

                    }

                    ?>
                </span></h3>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <th width="20%">Serial</th>
            <th width="20%">Name</th>
            <th width="20%">Usernaem</th>
            <th width="20%">Email Address</th>
            <th width="20%">Action</th>

            <tr>
                <td>01</td>
                <td>Mahabub</td>
                <td>Rahman</td>
                <td>mahabub@test.com</td>
                <td>
                    <a class="btn btn-primary" href="profile.php?id=1">View</a>
                </td>
            </tr>
            <tr>
                <td>01</td>
                <td>Rahul</td>
                <td>Al</td>
                <td>mrahul@test.com</td>
                <td>
                    <a class="btn btn-primary" href="profile.php?id=1">View</a>
                </td>
            </tr>
            <tr>
                <td>01</td>
                <td>arif</td>
                <td>Rahman</td>
                <td>arif@test.com</td>
                <td>
                    <a class="btn btn-primary" href="profile.php?id=1">View</a>
                </td>
            </tr>


        </table>
    </div>
</div>


<?php include 'inc/footer.php' ?>s