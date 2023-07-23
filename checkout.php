<?php
include "header.php";
include "./partials/db.php";
$userId = $_SESSION['id'];

if (isset($_POST['order'])) {
    $status = "pending";
    $address = $_POST['address'];
    $order_date = date("Y-m-d H:i:s");
    $payment_method = "cod";

    $cart_total = 0;
    $cart_products = [];

    // Fetch products from the cart
    $query = "SELECT cart.cart_id, cart.user_id, artworks.artwork_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
        FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";

    $result = mysqli_query($conn, $query) or die('query failed');

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $artwork_id = $row['artwork_id'];
            $quantity = $row['quantity'];

            // Add the product details to the cart products array
            $cart_products[] = [
                'artwork_id' => $artwork_id,
                'title' => $row['title'],
                'image_path' => $row['image_path'],
                'price' => $row['price'],
                'quantity' => $quantity
            ];
            

            $sub_total = ($row['price'] * $quantity);
            $cart_total += $sub_total;
        }
    }

    if(!empty($cart_products)){
    // Insert order into the `orders` table
    mysqli_query($conn, "INSERT INTO `orders`(`user_id`, `order_date`, `total_amount`, `status`, `shipping_address`, `payment_method`)
        VALUES ('$userId','$order_date','$cart_total','$status','$address','$payment_method')") or die('query failed');

    // Retrieve the newly inserted order_id
    $order_id = mysqli_insert_id($conn);
    echo 'Order ID: ' . $order_id . '<br>';

    // Insert order items into the `order_items` table
    foreach ($cart_products as $product) {
        $artwork_id = $product['artwork_id'];
        $quantity = $product['quantity'];

        mysqli_query($conn, "INSERT INTO `order_items`(`order_id`, `artwork_id`, `quantity`)
            VALUES ('$order_id','$artwork_id','$quantity')") or die('query failed');
    }

    // Delete cart items from the `cart` table
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$userId'") or die('query failed');

    // Display the cart products or use them as needed in your code
    foreach ($cart_products as $product) {
        echo '<div class="artist-card">';
        echo "Artwork ID: " . $product['artwork_id'] . "<br>";
        echo "Title: " . $product['title'] . "<br>";
        echo "Image: <img src='" . $product['image_path'] . "' alt='Product Image'><br>";
        echo "Price: " . $product['price'] . "<br>";
        echo "Quantity: " . $product['quantity'] . "<br>";
        echo "<br>";
        echo '</div>';

    }

    // $total_products = implode(', ', array_column($cart_products, 'artwork_id'));
    // echo "Total Products: " . $total_products;

    echo "<script>
    Swal.fire({
        title: 'Order placed',
        text: 'The order has been successfully placed.',
        icon: 'success',  
        confirmButtonText: 'OK'
      });
    
    </script>";
}else{
    echo "<script>
        Swal.fire({
            title: 'Cart is empty',
            text: 'Cannot place an order with an empty cart.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        </script>";
}
}
?>

<section>
    <h3>Checkout</h3>
</section>

<section class="display-order">
    <?php
    $grand_total = 0;
    $query = "SELECT cart.cart_id, cart.user_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
        FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $total_price = ($row['price'] * $row['quantity']);
            $grand_total += $total_price;
            ?>

            <p><?php echo $row['title'] ?></p>
        <?php
        }
    } else {
        echo '<p class="empty">Your cart is empty</p>';
    }
    ?>
    <div class="grand-total">Grand Total: <span>$<?php echo $grand_total; ?>/-</span></div>
</section>

<section class="checkout">
    <form action="" method="POST">
        <h3>Place your order</h3>
        <div class="flex">
            <div class="inputBox">
                <span>Address:</span>
                <input type="text" name="address" placeholder="E.g. Street, City, Country">
            </div>
        </div>
        <input type="submit" name="order" value="Order now" class="btn">
    </form>
</section>
