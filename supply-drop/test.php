<?php
/*This file test the basics concepts of PHP that I am trying to implement for Supply Drop

@author Daniel Grimm*/

//Read from a file to get the query
$myfile = fopen("query.txt", "r") or die("Unable to open file!");
$input = fread($myfile,filesize("query.txt"));
fclose($myfile);

//Get the number of the command
$number = substr($input, 0, 1);
$command = substr($input, 2, filesize("query.txt") - 2);

//The queries that can be run
$query_0 = "SELECT * FROM USER;";
$query_1 = "SELECT username, password FROM USER WHERE USER.username = '" . $command . "';";

//Connect to the database
$db = mysqli_connect('localhost','root','','supply-drop') or die('Error connecting to MySQL server.');

//Successfully connected so query the database
if ($number == 0) {
    $result = $db->query($query_0);
} else if ($number == 1) {
    $result = $db->query($query_1);
} else {
    //Default error message
    die("Unknown Error.");
}

//Output the results of the query
if ($result->num_rows > 0) {
    // output data of each row of the query
    while($row = $result->fetch_assoc()) {
        if ($number == '0') {
            echo $row["username"]. " " . $row["password"]. " " . $row["firstName"]. "<br>";
        } else if ($number == '1') {
            echo $row["username"]. " " . $row["password"] . "<br>";
        } else {
            echo die("Unknown Error (2)");
        }
    }
} else {
    //no results to return
    echo "0 results";
}

?>