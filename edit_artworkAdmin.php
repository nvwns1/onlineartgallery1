<?php
include("partials/db.php");
$id = "";
$title = "";
$description = "";
$error = "";
$success = "";
include("admin.php");

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
        header("location: allartist.php");
        exit();
    }

    $title=$row["title"];
    $description = $row["description"];
}else{
    $artwork_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "update artworks set title = '$title', description= '$description' where artwork_id=$artwork_id";
    $result = $conn->query($query);
    if ($result){
        header("location: allartist.php");
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
    <input type="submit" value="Edit Artwork">
</form>