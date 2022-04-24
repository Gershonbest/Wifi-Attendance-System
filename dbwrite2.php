

<?php



    $host = "localhost";                 // host = localhost because database hosted on the same server where PHP files are hosted
    $dbname = "id17971502_usman";              // Database name
    $username = "id17971502_20214000";      // Database username
    $password = "Usman&sarumi12";         // Database password


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

  if(!empty($_POST['Name']) && !empty($_POST['Classroom']) && !empty($_POST['stdno']) )
    {
        $Name = $_POST['Name'];
                $Classroom = $_POST['Classroom'];
                         $stdno=$_POST['stdno'];


// Update your tablename here
            $sql = "INSERT INTO my_table (Name, Classroom,stdno, Date, Time) VALUES ('".$Name."','".$Classroom."','".$stdno."', '".$d."', '".$t."')"; 
 


        if ($conn->query($sql) === TRUE) {
            echo "Values inserted in MySQL database table.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


// Close MySQL connection
$conn->close();



?>
