<?php



   $host = "fdb34.awardspace.net";		         // host = localhost because database hosted on the same server where PHP files are hosted
    $dbname = "4010082_wifiattend";              // Database name
    $username = "4010082_wifiattend";		// Database username
    $password = "XgXBRe662@+j%yb";	        // Database password



// Establish connection to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if connection established successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

else { echo "Connected to mysql database. ";

}

// Get date and time variables
    date_default_timezone_set('Asia/Nicosia');  // for other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
    $d = date("Y-m-d");
    $t = date("H:i:s");
   
 
 /* =========== this is just some hard code used for testing  ==================  
    $stdno = "20215448";
    $course_id ="AIE559";
    $room_id ="LAB 14";
    $temp ="00:00:00";
    $check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `attendance_sheet` WHERE `Date`= '".$d."' AND `stdno`='".$stdno."' "));
    if($check==0){
                $sql1 = "INSERT INTO `attendance_sheet` (`id`, `stdno`, `course_id`, `room_id`, `Date`, `Time`, `Time_out`) VALUES (NULL, '".$stdno."', '".$course_id."','".$room_id."', '".$d."', '".$t."','$temp' )";
        mysqli_query($conn,$sql1);
    }else{
                $sql2 = "UPDATE `attendance_sheet` SET `Time_out` ='".$t."' WHERE `stdno`='".$stdno."' AND `Date`= '".$d."' ";
        mysqli_query($conn,$sql2);
    }
*/
    
    
// If values send by NodeMCU are not empty then insert into MySQL database table

  if(!empty($_POST['stdno']) && !empty($_POST['course_id']) && !empty($_POST['room_id']) )
    {
		$stdno = $_POST['stdno'];
                $course_id = $_POST['course_id'];
                         $room_id=$_POST['room_id'];



// Update your table here
    $temp ="00:00:00";
    $check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `attendance_sheet` WHERE `Date`= '".$d."' AND `stdno`='".$stdno."' "));
    
    if($check==0){
                $sql1 = "INSERT INTO `attendance_sheet` (`id`, `stdno`, `course_id`, `room_id`, `Date`, `Time`, `Time_out`) VALUES (NULL, '".$stdno."', '".$course_id."','".$room_id."', '".$d."', '".$t."','$temp' )";
        mysqli_query($conn,$sql1);
    }else{
                $sql2 = "UPDATE `attendance_sheet` SET `Time_out` ='".$t."' WHERE `stdno`='".$stdno."' AND `Date`= '".$d."' ";
        mysqli_query($conn,$sql2);
    }


}
	


// Close MySQL connection
$conn->close();

exit();

?>

