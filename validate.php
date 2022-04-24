<?php
include('db_conn.php');

if (isset($_POST['submit'])){


    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check=mysqli_query($conn, "SELECT * FROM lecturers WHERE email='$email' ");
    $checkrows=mysqli_num_rows($check);
    if($checkrows>0){
    echo "<script> alert('Email is used by another user')
    location.href='register.php'</script>";	
    }
    else{



        $sql="INSERT INTO lecturers (name, email, password) VALUES('$name', '$email', '$password')";
        mysqli_query($conn,$sql) or die (mysqli_error($conn));
        $num=mysqli_insert_id($conn);
        if(mysqli_affected_rows($conn)!=1){
            $message="error inserting into DB";
    
    }
     


	
	    echo "<script>alert('registration successful  ')
     location.href='login.php'</script>";



    }






}



?>