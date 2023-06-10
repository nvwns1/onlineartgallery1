<?php
include("partials/db.php");
include("header.php");

$id= $_SESSION['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist_id = $id;
    $description = $_POST['description'];
    $creation_date = time();

    // Handle the uploaded image
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    $image_path = 'photo/' . $image_name;

    // Move the uploaded image to the desired directory
    move_uploaded_file($image_tmp, $image_path);

    // Insert the data into the Artworks table
    $query = "INSERT INTO Artworks (title, artist_id, description, image_path, creation_date) 
              VALUES ('$title', '$artist_id', '$description', '$image_path', '$creation_date')";
    
    if (mysqli_query($conn, $query)) {
        // Data inserted successfully
        echo "Artwork added successfully!";
        header("location: user.php");
    } else {
        // Error inserting data
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST" action="#" enctype="multipart/form-data">
  <label>Title:</label>
  <input type="text" name="title" required>
  <br>

  <!-- <label>Artist ID:</label>
  <input type="number" name="artist_id" required>
  <br> -->

  <label>Description:</label>
  <textarea name="description"></textarea>
  <br>

  <label>Image:</label>
  <input type="file" name="image" accept="image/*" required>
  <br>

  <!-- <label>Price:</label>
  <input type="number" name="price" step="0.01" required>
  <br> -->
<!-- 
  <label>Creation Date:</label>
  <input type="date" name="creation_date" required> -->
  <br>

  <input type="submit" value="Add Artwork">
</form>
