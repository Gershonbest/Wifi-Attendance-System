<?php
include('db_conn.php');

if(isset($_POST['submit']))
{
  $email=$_POST['email'];
  $pass=$_POST['password'];

  $select=mysqli_query($conn, "update lecturers set password='$pass' where email='$email'");

  if($select){
    echo "<script>alert('Password reset successful')
    location.href='login.php'</script>";
  }
}
?>