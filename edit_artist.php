<?php
include("partials/db.php");
$id = "";
$fname = "";
$lname = "";
$email ="";

$error = "";
$success = "";
include("header.php");

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
        header("location: index.php");
        exit();
    }

    $fname=$row["fname"];
    $lname=$row["lname"];
    $email=$row["email"];
    $status = $row["status"];
}else{
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $query = "update users set fname = '$fname', lname= '$lname',
     email = '$email', status = '$status'
     where id=$id";
    $result = $conn->query($query);
    if ($result){
        $_SESSION['fname'] = $fname;
        $_SESSION['lname']= $lname;
        $_SESSION['email']= $email;
        header("location: user.php");
        exit();
    }else{
        $error ="Unable to Edit";
    }
    }
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <h2>Edit Artist</h2>
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
    <br>
    <input type="submit" value="Submit">


</form>