<?php
$currentStatus = 'pending';

include "adminorderTemplate.php";
include "partials/db.php";

$grand_total = 0;
$msg = "";

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['order_status'];
    mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'") or die('Query failed');
    $msg = "Status updated successfully!";
}


$query = "SELECT * From orders WHERE status='pending'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class = 'big-container'>";
        $order_id = $row['order_id'];
        $order_date = $row['order_date'];
        $total_amount = $row['total_amount'];
        $status = $row['status'];
        $shipping_address = $row['shipping_address'];
        $payment_method = $row['payment_method'];

        echo "Order ID: " . $order_id . "<br>";
        echo '<p> 
        Order Date: ' . $order_date .   '</br>' .
            'Status: ' . $status . '<br>'.
        'Shipping Address: ' . $shipping_address . '<br>'.
        'Payment Method: ' . $payment_method . '<br>'.
        '</p>';


        echo '<h4>' . "Total Amount: " . $total_amount .  '</h4>';


        $items_query = "SELECT artworks.title, artworks.image_path,
        artworks.price,
        order_items.quantity FROM order_items
        INNER JOIN artworks ON order_items.artwork_id = artworks.artwork_id
        WHERE order_items.order_id = $order_id
        ";

        $items_result = mysqli_query($conn, $items_query) or die('Query failed');
        if (mysqli_num_rows($items_result) > 0) {
            echo "<div class=artist-container>";

            while ($item_row = mysqli_fetch_assoc($items_result)) {
                echo "<div class=artist-card>";
                $title = $item_row['title'];
                $image_path = $item_row['image_path'];
                $quantity = $item_row['quantity'];
                $artwork_price = $item_row['price'];
                echo '<h2>' . $title .  '</h2>';
                echo '<img src="' . $image_path . '">';
                echo '<p>' . "Price: " . $artwork_price .  '</p>';
                echo '<p>' . "Quantity: " . $quantity .  '</p>';
                echo '<h4>' . "Total Price: " . $artwork_price * $quantity .  '</h4>';
                echo "<br>";
                echo "</div>";
            }
            echo "</div>";
        }

        ?>
<form  method="post" action=''>
<input type="hidden" name="order_id" value= <?php echo $order_id ;?>>
<input type="radio" name="order_status" value="delivered">
<label for="delivered">Delivered</label>
<input type="radio" name="order_status" value="canceled">
<label for="delivered">Canceled</label>
<br>
<input type="submit" value="Save" class="btn" name="update_status">
</form>
<?php
        echo "</div>";
    }
}  else {
    echo '<div class="empty">';
    echo '<h2>No pending orders found.</h2>';
    echo '</div>';
}

?>