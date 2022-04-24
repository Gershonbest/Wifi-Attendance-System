<?php
//login.php

include("db_conn.php");
$message = " ";
$message1 = " ";


session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin_a"]) && $_SESSION["loggedin_a"] === true){
  header("location: index.php");
  exit;
}


if(isset($_POST["submit"]))
{
    $email = $_POST['email'];


    $sql="SELECT * FROM lecturers WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_array($result)) {
				
                
				if($_POST["password"] == $row["password"])
				{
                    session_start();
                    $_SESSION["loggedin_a"] = true;
                    $_SESSION["uin_a"] = $row['unique_id'];
                    $_SESSION["id_a"] = $row['id'];
                
                   


					header("location:index.php");
				}
				else
				{
                    $message = "wrong Password";
                    echo "<script>alert('$message ')
     location.href='login.php'</script>";
        
          
				}
			
			
		
            }
        }
        else{
            $message1 = " Account does not Exist";
            echo "<script>alert('$message1 ')
            location.href='login.php'</script>";
    }
	
        }
        mysqli_close($conn);
?>