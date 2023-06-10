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
    $query = "Select * From users where id = '$id'";
    $result = $conn->query($query);

    $row = $result->fetch_array();


    while(!$row){
        header("location: allartist.php");
        exit();
    }

    $fname=$row["fname"];
    $lname=$row["fname"];
    $email=$row["email"];
    $status = $row["status"];
    $activeChecked = ($status === "active") ? "checked" : "";
    $suspendChecked = ($status === "suspend") ? "checked" : "";
}else{
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    $query = "update users set fname = '$fname', lname= '$lname',
     email = '$email', status = '$status'
     where id=$id";
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
    <label>First name:</label>
    <input type="text" name="fname"  value="<?php echo $fname; ?>" >
    <br>
    <label>Last name:</label>
    <input type="text" name="lname"  value="<?php echo $lname; ?>" >
    <br>
    <label>Email:</label>
    <input type="text" name="email"  value="<?php echo $email; ?>" >
    <br>
    <label>Status:</label>
    <br>
    <input type="radio" id="activeRadio" name="status" value="active" <?php echo $activeChecked; ?>>
    <label for="activeRadio">Active</label>

    <input type="radio" id="suspendRadio" name="status" value="suspend" <?php echo $suspendChecked; ?>>
    <label for="suspendRadio">Suspend</label>
    
    <br>
    <br>
    <input type="submit" value="Edit Artist">


</form>