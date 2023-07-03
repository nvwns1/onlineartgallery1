<?php
include "header.php";
include "./partials/db.php";
$userId = $_SESSION['id'];

if(isset($_POST['order'])){
    $status="Ordered";

    $address = $_POST['address'];
    $order_date=date("Y_m_d h:i:sa");

    $cart_total = 0;
    $cart_products[] = '';
    $payment_method = "cod";

    /*
    $query = "SELECT cart.cart_id, cart.user_id,artworks.artwork_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
        FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";
    
    $result = mysqli_query($conn, $query)or die('query failed');
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $cart_products[] = $row['artwork_id']. ' ('.$row['quantity'].') ';
            $sub_total = ($row['price']* $row['quantity']);
            $cart_total +=$sub_total;
        }
    }
    $total_products = implode(', ', $cart_products);
    echo $total_products;
    */

    // Fetch products from the cart
$query = "SELECT cart.cart_id, cart.user_id, artworks.artwork_id, artworks.title, artworks.image_path, artworks.price, cart.quantity
FROM cart INNER JOIN artworks ON artworks.artwork_id = cart.artwork_id WHERE cart.user_id = $userId";

$result = mysqli_query($conn, $query) or die('query failed');

// Create an empty array to store the cart products
$cart_products = [];

if (mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_assoc($result)) {
$artwork_id = $row['artwork_id'];
$quantity = $row['quantity'];

// Insert order item into the `order_items` table
mysqli_query($conn, "INSERT INTO `order_items`(`order_id`, `artwork_id`, `quantity`)
VALUES ('$order_id','$artwork_id','$quantity')");

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

// Delete cart items from the `cart` table
mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$userId'") or die('query failed');

// Display the cart products or use them as needed in your code
foreach ($cart_products as $product) {
echo "Artwork ID: " . $product['artwork_id'] . "<br>";
echo "Title: " . $product['title'] . "<br>";
echo "Image Path: " . $product['image_path'] . "<br>";
echo "Price: " . $product['price'] . "<br>";
echo "Quantity: " . $product['quantity'] . "<br>";
echo "<br>";
}

$total_products = implode(', ', array_column($cart_products, 'artwork_id'));
echo $total_products;

    // $order_query = mysqli_query($conn,
    //  "SELECT * FROM `orders` WHERE name = '$name' 
    //  AND number = '$number' AND email = '$email' 
    //  AND status = '$status' AND address = '$address' 
    //  AND total_products = '$total_products' 
    //  AND total_price = '$cart_total'") or die('query failed');  


    if($cart_total == 0){
        $message[] = 'your cart is empty';
    // }
    // elseif(mysqli_num_rows($order_query)>0){
    //     echo "<script>
    //     alert('order placed')
    //     ";
    //     echo "</script>";
    }else{
        mysqli_query($conn, "
        INSERT INTO `orders`( `user_id`, `order_date`, `total_amount`, `status`, `shipping_address`, `payment_method`) 
        VALUES ('$userId','$order_date','$cart_total','$status','$address','$payment_method')");

        // Retrieve the newly inserted order_id
$order_id = mysqli_insert_id($conn);
echo 'this'. $order_id;


        
// Insert order items into the `order_items` table
foreach ($cart_products as $cart_product) {
  $artwork_id = $cart_product['artwork_id'];
  $quantity = $cart_product['quantity'];

  mysqli_query($conn, "INSERT INTO `order_items`(`order_id`, `artwork_id`, `quantity`)
  VALUES ('$order_id','$artwork_id','$quantity')");
}

        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$userId'") or die('query failed');
        echo "<script>

                alert('order placed successfully');
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
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $total_price = ($row['price'] * $row['quantity']);
            $grand_total += $total_price;
            ?>

            <p><?php echo $row['title']?></p>
            <?php
        }
    }else{
        echo '<p class="empty">your card is empty</p>';
    }
    ?>
        <div class="grand-total">grand total : <span>$<?php echo $grand_total; ?>/-</span></div>

    
</section>


<section class="checkout">

    <form action="" method="POST">

        <h3>Place your order</h3>

        <div class="flex">
            
            
            <div class="inputBox">
                <span>Address :</span>
                <input type="text" name="address" placeholder="E.g. Street, City, Country">
            </div>
            
        </div>

        <input type="submit" name="order" value="Order now" class="btn">

    </form>

</section>
