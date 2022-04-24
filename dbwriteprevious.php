

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

else { echo "Connected to mysql database. "; }

   
// Get date and time variables
    date_default_timezone_set('EET');  // for other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
    $d = date("Y-m-d");
    $t = date("H:i:s");
    
// If values send by NodeMCU are not empty then insert into MySQL database table

  if(!empty($_POST['stdno']) && !empty($_POST['course_id']) && !empty($_POST['room_id']) )
    {
		$stdno = $_POST['stdno'];
                $course_id = $_POST['course_id'];
                         $room_id=$_POST['room_id'];


// Update your tablename here
	        $sql = "INSERT INTO attendance_sheet (stdno, course_id, room_id, Date, Time) VALUES ('".$stdno."','".$course_id."','".$room_id."', '".$d."', '".$t."')"; 
 


		if ($conn->query($sql) === TRUE) {
		    echo "Values inserted in MySQL database table.";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


// Update your tablename here
	         
/*

$check = SELECT * FROM attendance_sheet WHERE `Date` = DAY(CURDATE) AND `stdno`='".$stdno."';
$rows = mysqli_num_rows($check);

if($rows == 1){
       $sql = "UPDATE attendance_sheet SET `Time_out`='".$t."' WHERE `stdno`='".$stdno."' AND `Date` = '".$d."' ";
       mysqli_query($conn,$sql);
     }
else {
       $sql = "INSERT INTO attendance_sheet (stdno, course_id, room_id, Date, Time) VALUES ('".$stdno."','".$course_id."','".$room_id."', '".$d."', '".$t."')";
       mysqli_query($conn,$sql);

    }
*/

// Close MySQL connection
$conn->close();

exit();

?>
