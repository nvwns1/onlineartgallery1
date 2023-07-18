    <head>
        <style>
            .artist-card{
                cursor: default;
            }
        </style>
    </head>
    <?php
    include 'admin.php';
    include 'partials/db.php';

    echo '<h2 class="hero-text">All Artist</h2>';
    

    $query = "Select * From users where username != 'admin'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="artist-container">';
        
        while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        echo '<div class="artist-card">';
        echo '<img src="photo/' . $row['pp'] . '">';
        echo '<h2>' . $row['fname'] . ' ' . $row['lname'] .  '</h2>';
        echo '<p>Email: ' . $row['email'] . '</p>';
        echo '<p>Username: ' . $row['username'] . '</p>';
        echo '<p>Status: ' . $row['status'] . '</p>';

        echo '<div class="link-container">';
        echo '<a class="edit-link" href="edit_artistAdmin.php?id='.$id.'">Edit</a>';
       echo "<a class='delete-link' onclick=\"return confirm(
        'Are you sure to delete?')\" 
        href='deleteArtist.php?id=$id'>Delete</a>";
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<div class='hero empty'>";
    echo '<p>No artists found.</p>';
    echo "</div>";
}
    mysqli_close($conn);
    ?>

