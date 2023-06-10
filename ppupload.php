<?php
// upload.php

// Assuming you have established a database connection

include("partials/db.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate and process the uploaded file
  if (isset($_FILES['profilePicture'])
  //  || $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK
  ) 
   {
    session_start();
    $username = $_SESSION['username']; // Replace with the actual session variable nameW
    
    // Get the file details
    echo "<pre>";
    print_r($_FILES['profilePicture']['name']);
    echo "</pre>";
    $fileTmpPath = $_FILES['profilePicture']['tmp_name'];
    $fileName = $_FILES['profilePicture']['name'];
    $fileSize = $_FILES['profilePicture']['size'];
    $fileType = $_FILES['profilePicture']['type'];
    
    // Generate the new filename
    $newFileName = $username . '.png'; // You can use a different file extension if needed
    
    // Set the destination directory for the uploaded file
    $uploadDir = './photo/'; // Specify your desired directory
    
    // Move the uploaded file to the destination directory
    $destPath = $uploadDir . $newFileName;
    move_uploaded_file($fileTmpPath, $destPath);
    
    // Update the database with the new profile picture filename
    $updateQuery = "UPDATE `users` SET `pp`='$newFileName' WHERE `username`='$username'";
    $result = mysqli_query($conn, $updateQuery);
    
    if ($result) {
      echo 'Profile picture changed successfully.';
    } else {
      echo 'Failed to update the profile picture.';
    }
  } else {
    echo 'Failed to upload the profile picture.';
  }
}

header('location: user.php');


?>