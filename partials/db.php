<?php
    // Database configuration variables
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "OAG";

    // Create a database connection
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    // Check if the connection was successful
    if(!$conn) {
        echo "DataBase Disconnected";
    }   
?>
