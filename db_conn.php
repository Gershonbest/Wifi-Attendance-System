<?php
                              //username  password   dbname
$conn=new mysqli("localhost", "root", "", "school");
if (mysqli_connect_errno()){
	printf("connect failed: %s\n", mysqli_connect_error());
	exit();

}







?>