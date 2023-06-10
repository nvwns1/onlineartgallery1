<?php
include "admin.php";


$id = $_GET['id'];
$q ="Delete From `artworks` where artwork_id=$id";
include "partials/db.php";

$res=mysqli_query($conn, $q)  or die(mysqli_error($con));;
echo "<div class='hero'";
echo "<div class='delete-msg'> <p>Artwork Deleted!! </p> </div>";
echo '<a href="allartwork.php">Click here to GO to artwork Page.</a>';

?>


</div>