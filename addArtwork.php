<?php
include("partials/db.php");
include("header.php");

$id= $_SESSION['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $artist_id = $id;
    $description = $_POST['description'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];

    // Handle the uploaded image
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    $image_path = 'photo/' . $image_name;

    // Move the uploaded image to the desired directory
    move_uploaded_file($image_tmp, $image_path);

    // Insert the data into the Artworks table

    $query = "INSERT INTO artworks (title, artist_id, description,
    price, units_available,
     image_path) 
    VALUES (?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sissis", $title, $artist_id, $description,
  $price, $unit,
$image_path);

if (mysqli_stmt_execute($stmt)) {
echo "Artwork added successfully!";
header("location: user.php");
} else {
echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);

}
?>

<form method="POST" action="#" enctype="multipart/form-data">
  <label>Title:</label>
  <input type="text" name="title" required>
  <br>


  <label>Description:</label>
  <textarea name="description"></textarea>
  <br>

  <label>Price:</label>
  <input type="number" name="price" required>
  <br>

  <label>Unit Available:</label>
  <input type="number" name="unit" required>
  <br>

  <label>Image:</label>
  <input type="file" name="image" accept="image/*" required>
  <br>
  <br>

  <input type="submit" value="Add Artwork">
</form>
