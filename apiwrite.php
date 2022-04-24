
<?php

    $host = "fdb34.awardspace.net";	   // host  =  localhost because database hosted on the same server where PHP files are hosted
    $dbname = "4010082_wifiattend";              // Database name
    $username = "4010082_wifiattend";		       // Database username
    $password = "XgXBRe662@+j%yb";	           // Database password


// Establish connection to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if connection established successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

else { echo "Connected to mysql database. ";

}

// Get date and time variables
    date_default_timezone_set('EET');  // for other timezones, refer:- https://www.php.net/manual/en/timezones.asia.php
    $d = date("Y-m-d");
    $t = date("H:i:s");
// set the duration of the class in hours minutes and seconds. Just adjust the numbers in the line below
    $duration = '+ 0 hours + 2 minutes + 0 seconds';
    
// set a temporary Time_out to be inserted in the Time_out column
    $temp = '00:00:00';
    



/*
// ================== HARD CODING FOR TESTING PURPOSES =============================
  if(empty($_POST['std_mac_adr']) && empty($_POST['course_id']) && empty($_POST['room_id']) )
    {
		$std_mac_adr = 'MYMACADDR';//$_POST['std_mac_adr'];
                $course_id = 'COM 559';//$_POST['course_id'];
                $room_id= 'LAB14';$_POST['room_id'];
                         echo "Data ready for insertion";



    $check1 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM attend_with_MAC where `Date` ='".$d."' AND `std_mac_adr` ='".$std_mac_adr."' "));
                         echo "  Number of Rows is:___  "."$check1";
// Update your tablename here

    if($check1 == 0){
	        $sql = "INSERT INTO attend_with_MAC (`id`, `std_mac_adr`, `course_id`, `room_id`, `Date`, `Time`, `Time_out`) VALUES (NULL, '".$std_mac_adr."','".$course_id."','".$room_id."', '".$d."', '".$t."', '".$temp."')"; 
                mysqli_query($conn,$sql);
                          echo "Insertion Done Successfully";
        
        }else{
        $check2 = mysqli_query($conn, "SELECT * FROM attend_with_MAC where `Date` ='".$d."' AND `std_mac_adr` ='".$std_mac_adr."' ");
        $row = $check2 -> fetch_array(MYSQLI_ASSOC);
                         echo "Stored time is: "."<br>";
                         echo $row['Time']; 
                         echo "time now is: "."<br>";
                         echo $t;

    

         $endTime = date('H:i:s',strtotime($duration, strtotime($row['Time'])));
         //$end = $row['Time'] + $class_duration;
         echo "<br>";
         echo $endTime;
    
    if($t >= $endTime && $row['Time_out'] == $temp){
            $sql2 = "UPDATE attend_with_MAC SET Time_out = '".$t."' WHERE std_mac_adr = '$std_mac_adr' AND `Date` ='".$d."' ";
           mysqli_query($conn, $sql2);
                            echo "Time_out updated Successfully";
            
            }
    
         }
    }
// ================== END OF HARD CODING ===========================================
*/





// ================== MAIN EXECUTABLE STARTS HERE =============================
  if(!empty($_POST['std_mac_adr']) && !empty($_POST['course_id']) && !empty($_POST['room_id']) )
    {
		$std_mac_adr = $_POST['std_mac_adr'];
                $course_id = $_POST['course_id'];
                $room_id= $_POST['room_id'];
                         echo "Data ready for insertion";


// Check if student has logged in for the first time
    $check1 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM attend_with_MAC where `Date` ='".$d."' AND `std_mac_adr` ='".$std_mac_adr."' "));


    if($check1 == 0){
	        $sql = "INSERT INTO attend_with_MAC (`id`, `std_mac_adr`, `course_id`, `room_id`, `Date`, `Time`, `Time_out`) VALUES (NULL, '".$std_mac_adr."','".$course_id."','".$room_id."', '".$d."', '".$t."', '".$temp."')"; 
                mysqli_query($conn,$sql);
                          echo "Insertion Done Successfully";
        
        }else{
        $check2 = mysqli_query($conn, "SELECT * FROM attend_with_MAC where `Date` ='".$d."' AND `std_mac_adr` ='".$std_mac_adr."' ");
        $row = $check2 -> fetch_array(MYSQLI_ASSOC);
   
        $endTime = date('H:i:s',strtotime($duration, strtotime($row['Time'])));

    
    if($t >= $endTime && $row['Time_out'] == $temp){
            $sql2 = "UPDATE attend_with_MAC SET Time_out = '".$t."' WHERE std_mac_adr = '$std_mac_adr' AND `Date` ='".$d."' ";
           mysqli_query($conn, $sql2);
                            echo "Time_out updated Successfully";
            
            }
    
         }
    }
// ================== END OF MAIN CODE ===========================================









// Close MySQL connection
$conn->close();

exit();

?>
