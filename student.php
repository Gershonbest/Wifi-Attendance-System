<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include('db_conn.php');
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>attendance system| sign in</title>

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
    <a href="index.php"><b>Students   </b>Registration</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register as a new student</p>



      <?php
      if(isset($_POST['submit'])){
          $stdno = $_POST['stdno'];
          

        $check=mysqli_query($conn, "SELECT * FROM students WHERE stdno='$stdno' ");
        $checkrows=mysqli_num_rows($check);
        if($checkrows>0){
        echo "<script> alert('Student number already exists')
        location.href='student.php'</script>";	
        }
        else{

        $sql="INSERT INTO students (stdno, Name, Surname) VALUES('$_POST[stdno]', '$_POST[Name]', '$_POST[Surname]')";
        mysqli_query($conn,$sql) or die (mysqli_error($conn));
        $num=mysqli_insert_id($conn);
        if(mysqli_affected_rows($conn)!=1){
            $message="error inserting into DB";
    
    }

    echo "<script>alert('registration successful ')</script>";
     

  }


      }
      
      
      ?>


      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Name" required="required" name="Name">
          <div class="input-group-append">
            <div class="input-group-text">
             <!-- <span class="fas fa-envelope"></span>-->
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Surname" required="required" name="Surname">
          <div class="input-group-append">
            <div class="input-group-text">
           <!--   <span class="fas fa-envelope"></span>-->
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="Student Number" required="required" name="stdno">
          <div class="input-group-append">
            <div class="input-group-text">
              <!--<span class="fas fa-envelope"></span>-->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="submit" >Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
