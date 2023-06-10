<?php
include "admin.php";


$id = $_GET['id'];
// if($_SESSION['username'] !="admin"){
//     header("location: index.php");
//     exit();
// }
$q ="Delete From `users` where id=$id";
include "partials/db.php";

$res=mysqli_query($conn, $q)  or die(mysqli_error($con));;
echo "<div class='hero'";
echo "<div class='delete-msg'> <p>Artist Deleted!! </p> </div>";
echo '<a href="allartist.php" class="button">Click here to GO to Artist Page.</a>';

?>


</div>