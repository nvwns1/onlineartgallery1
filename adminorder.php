
<?php include"admin.php" ;
include "./partials/db.php"
?>
<!DOCTYPE html>
<html>
<head>
  <title>Order Items</title>
</head>
<body>
  <h1>Order Items</h1>

  <?php
    // Assuming you have a database connection established
    
    // Query to retrieve order items from the database
    $query = "SELECT * FROM orders";
    $result = mysqli_query($conn, $query);

    // Check if there are any order items
    if (mysqli_num_rows($result) > 0) {
      // Loop through each order item and display the details
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>Order ID: " . $row['order_id'] . "</p>";
        echo "<p>User ID: " . $row['user_id'] . "</p>";
        echo "<p>Artwork ID: " . $row['artwork_id'] . "</p>";
        echo "<p>Quantity: " . $row['quantity'] . "</p>";
        echo "<hr>";
      }
    } else {
      echo "<p>No order items found.</p>";
    }
    
    // Close the database connection
    mysqli_close($conn);
  ?>

</body>
</html>
