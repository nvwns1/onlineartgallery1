<?php
include("partials/db.php");
$id = "";
$title = "";
$description = "";
$price = "";
$unit = "";

$error = "";
$success = "";
include("header.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        header("location: index.php");
        exit();
    }

    $id = $_GET['id'];
    $query = "Select * FROM artworks WHERE artwork_id = ?";

    //prepare the statement
    $stmt = $conn->prepare($query);

    if ($stmt) {
        //Bind the Paramater
        $stmt->bind_param("i", $id);

        //Execute the statement
        $stmt->execute();

        //Get the result
        $result = $stmt->get_result();

        //Fetch the row
        $row = $result->fetch_assoc();

        if ($row) {
            $title = $row["title"];
            $description = $row["description"];
            $price = $row["price"];
            $unit = $row["units_available"];
        } else {
            header("location: index.php");
            exit();
        }

        // Close the statement
        $stmt->close();
    }
} else {
    $artwork_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST["price"];
    $unit = $_POST["unit"];


    $query = "UPDATE artworks SET title = ?, description = ?, price = ?, units_available = ? WHERE artwork_id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ssdii", $title, $description, $price, $unit, $artwork_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            header("location: index.php");
            exit();
        } else {
            $error = "Unable to Edit";
        }
        
        // Close the statement
        $stmt->close();
    }
}
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <h2>Edit Artwork</h2>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo $title; ?>">
    <br>
    <label>Description:</label>
    <textarea name="description"><?php echo $description; ?></textarea>
    <br>
    <label>Price:</label>
    <input type="number" name="price" value="<?php echo $price; ?>">
    <br>
    <label>Unit Available:</label>
    <input type="number" name="unit" value="<?php echo $unit; ?>">
    <br>

    <input type="submit" value="Edit Artwork">
</form>