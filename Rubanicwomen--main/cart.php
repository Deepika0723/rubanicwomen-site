<a href="cart.php"><img src="images/cart.png" width="30px" height="30px"></a>
<?php
include 'config.php';

$user_id = 1;
$sql = "SELECT * FROM cart WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="small-container cart-page">
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)): 
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
        ?>
        <tr>
            <td>
                <div class="cart-info">
                    <img src="<?php echo $row['image']; ?>">
                    <div>
                        <p><?php echo $row['product_name']; ?></p>
                        <small>Price: ₹<?php echo $row['price']; ?></small><br>
                        <a href="remove_from_cart.php?id=<?php echo $row['id']; ?>">Remove</a>
                    </div>
                </div>
            </td>
            <td><?php echo $row['quantity']; ?></td>
            <td>₹<?php echo $subtotal; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="total-price">
        <table>
            <tr>
                <td>Total</td>
                <td>₹<?php echo $total; ?></td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
