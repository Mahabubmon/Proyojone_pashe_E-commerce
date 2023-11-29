<?php include 'inc/header.php';
include 'lib/User.php';
$user = new User();
?>
<div class="panel panel-default">
    <div class="panel-headeing">
        <h2>User List <span class="float-right"><strong>Welcome!</strong></span></h2>
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