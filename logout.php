<?php
include('db_conn.php');
session_start();
unset($_SESSION["loggedin_a"]);
unset($_SESSION["id_a"]);


echo "<script>alert('Youve successfully logged out of  NEU attendance system')
     location.href='login.php'</script>";
        

 






?>