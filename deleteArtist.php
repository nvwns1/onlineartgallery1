<?php
include "admin.php";
include "./partials/db.php";

$id = $_GET['id'];

$q_delete_artworks = "DELETE FROM artworks WHERE artist_id = $id";
$res_delete_artworks = mysqli_query($conn, $q_delete_artworks) or die(mysqli_error($conn));

$q_delete_artist = "DELETE FROM users WHERE id = $id";
$res_delete_artist = mysqli_query($conn, $q_delete_artist) or die(mysqli_error($conn));

if ($res_delete_artist) {
    echo "<div class='hero'";
    echo "<div class='delete-msg'> <p>Artist Deleted!! </p> </div>";
    echo '<a href="allartist.php" class="button">Click here to go to the Artist Page.</a>';
} else {
    echo "<div class='hero empty'>";
    echo '<p>Failed to delete Artist!!</p>';
    echo "</div>";
}

