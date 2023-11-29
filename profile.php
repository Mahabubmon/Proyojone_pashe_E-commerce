<?php include 'inc/header.php' ?>
<div class="panel panel-default">
    <div class="panel-headeing">
        <h2>User Profile<span class="float-right">
                <a class="btn btn-primary" href="index.php">Back</a>
            </span></h2>
    </div>
    <div class="panel-body">
        <form action="" method="post">
            <div style="max-width:600px; margin:0 auto;">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="usernaem">User Name</label>
                    <input type="text" id="username" name="username" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" class="form-control" value="">
                </div>

                <button type="submit" name="Update" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>


<?php include 'inc/footer.php' ?>