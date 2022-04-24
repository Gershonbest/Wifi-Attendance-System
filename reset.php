<?php

include('db_conn.php');

if ($_GET['key'] && $_GET['reset']) {
    $email = $_GET['key'];
    $pass = $_GET['reset'];

    $select = mysqli_query($conn, "SELECT * FROM lecturers WHERE email='$email' and password='$pass'");
    if (mysqli_num_rows($select) == 1) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Attendance system| Log in</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
            <!-- icheck bootstrap -->
            <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/adminlte.min.css">
        </head>

        <body class="hold-transition login-page">
            <h1>Near East University</h1>
            <img src="neulogo.png" height="120" width="120">
            <h1>Wifi Attendance system</h1>
            <div class="login-box">
                <div class="login-logo">
                    <a href="index.php"><b>Change </b>Password</a>
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Enter new password</p>
                        <form method="post" action="submit_new.php">
                        <input type="hidden" name="email" value="<?php echo $email;?>">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button><br>
                        </form>
                    </div>
                </div>
            </div>

            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
        </body>

        </html>
<?php
    }
}
?>