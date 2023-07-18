<?php
include 'admin.php';
include 'partials/db.php';

echo '<h2 class="hero-text">All Artwork</h2>';

$query = "SELECT users.username,
artworks.artwork_id,
artworks.title,
artworks.description,
artworks.image_path
FROM artworks
INNER JOIN users ON users.id = artworks.artist_id;
";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo '<div class="artist-container">';
    while ($row = mysqli_fetch_assoc($result)) {
        $artwork_id = $row['artwork_id'];
        echo '<div class="artist-card">';
        echo '<img src="' .$row['image_path'] .'">';
        echo '<h2>' . $row['title'] .  '</h2>';
        // echo '<p>' . $row['description'] . '</p>';
        echo '<p>Artist: ' . $row['username'] . '</p>';
        
        echo '<div class="link-container">';
        echo '<a class="edit-link" href="edit_artworkAdmin.php?id='.$artwork_id.'">Edit</a>';
        echo "<a class='delete-link' onclick=\"return confirm(
            'Are you sure to delete?')\" 
            href='deleteArtwork.php?id=$artwork_id'>Delete</a>";
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<div class='hero empty'>";
    echo '<p>No Artwork found.</p>';
    echo "</div>";
}

    mysqli_close($conn);
    ?>

