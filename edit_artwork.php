<?php
include("partials/db.php");
$id = "";
$title = "";
$description = "";
$price ="";
$unit ="";

$error = "";
$success = "";
include("header.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(!isset($_GET['id'])){
        header("location: index.php");
        exit();
    }

    $id = $_GET['id'];
    $query = "Select * From artworks where artwork_id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_array();

    while(!$row){
        header("location: index.php");
        exit();
    }

    $title=$row["title"];
    $description = $row["description"];
    $price = $row["price"];
    $unit = $row["units_available"];

}else{
    $artwork_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $POST["price"];
    $unit = $POST["unit"];

    $query = "update artworks set title = '$title', description= '$description', price= '$price', units_available = '$unit'
     where artwork_id=$artwork_id";
    $result = $conn->query($query);
    if ($result){
        header("location: index.php");
        exit();
    }else{
        $error ="Unable to Edit";
    }


    }
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <h2>Edit Artwork</h2>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label>Title:</label>
    <input type="text" name="title"  value="<?php echo $title; ?>" >
    <br>
    <label>Description:</label>
    <textarea name="description"><?php echo $description; ?></textarea>
    <br>
    <label>Price:</label>
    <input type="number" name="price"  value="<?php echo $price; ?>" >
    <br>
    <label>Unit Available:</label>
    <input type="number" name="unit"  value="<?php echo $unit; ?>" >
    <br>

    <input type="submit" value="Edit Artwork">
</form>