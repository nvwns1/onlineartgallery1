<?php
include "header.php";
include 'partials/db.php';
$userId = $_SESSION['id'];

$grandtotal = 0;
$query = "SELECT oi.order_id, oi.quantity,
        oi.artwork_id, a.artist_id, a.image_path,
        a.units_available, a.title,
        a.price,
        o.user_id, o.status, u.username FROM order_items oi
        JOIN artworks a ON oi.artwork_id = a.artwork_id
        JOIN orders o ON oi.order_id = o.order_id
        JOIN users u ON o.user_id = u.id
        WHERE artist_id = $userId";
$result = mysqli_query($conn, $query);

$artworkData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $status = $row['status'];
    $price = $row['price'];
    $totalPrice = $row['price'] * $row['quantity'];
    if ($status == 'delivered') {
        $grandtotal += $totalPrice;
    }
    $row['totalPrice'] = $totalPrice;
    $artworkData[] = $row;
}
?>

<div class="hero">
    <h1>Order Dashboard</h1>
    <h1>Total Sales: Rs. <?php echo $grandtotal; ?></h1> 
</div>
<div class="artist-container" style="cursor:auto;">
    <?php
    foreach ($artworkData as $row) {
        $status = $row['status'];
        $totalPrice = $row['totalPrice'];
        echo '<div class="artist-card">';
        echo '<img src="' . $row['image_path'] . '" alt="artwork">';
        echo '<h2>' . $row['title'] . '</h2>';
        echo '<h2>Quantity:' . $row['quantity'] .
            '<br>Total Price: Rs. ' . $totalPrice .
            '<br>Delivery Status: ' . $status .
            '</h2>';
        echo '<p>Ordered By: ' . $row['username'] .
            '<br>Remaining Quantity: ' . $row['units_available'] .
            '<br>Price Each: Rs.' . $row['price'] .
            '</p>';
        echo '</div>';
    }
    ?>
</div>
