<?php
session_start();
include_once('includes/config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page with a return URL
    header("Location: login.php?redirect=" . urlencode($_SERVER['PHP_SELF']));
    exit();
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle removing items from cart
if (isset($_POST['remove_from_cart'])) {
    $tree_id = $_POST['tree_id'];
    unset($_SESSION['cart'][$tree_id]);
}

// Handle updating quantities
if (isset($_POST['update_quantity'])) {
    $tree_id = $_POST['tree_id'];
    $new_quantity = (int)$_POST['quantity'];
    if ($new_quantity > 0) {
        $_SESSION['cart'][$tree_id] = $new_quantity;
    } else {
        unset($_SESSION['cart'][$tree_id]);
    }
}

// Handle placing order
if (isset($_POST['place_order'])) {
    // Here you would typically:
    // 1. Validate the order
    // 2. Insert the order into your database
    // 3. Clear the cart
    // 4. Redirect to a thank you page
    // For now, we'll just clear the cart and show a message
    $_SESSION['cart'] = array();
    $order_placed = true;
}

// Fetch cart items from the database
$cart_items = array();
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    $tree_ids = implode(',', array_keys($_SESSION['cart']));
    $query = "SELECT * FROM trees WHERE id IN ($tree_ids)";
    $result = mysqli_query($con, $query);
    while ($tree = mysqli_fetch_assoc($result)) {
        $tree['quantity'] = $_SESSION['cart'][$tree['id']];
        $tree['subtotal'] = $tree['price'] * $tree['quantity'];
        $cart_items[] = $tree;
        $total_price += $tree['subtotal'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("includes/header.php"); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Cart</h1>
        
        <?php if (isset($order_placed)): ?>
            <div class="alert alert-success" role="alert">
                Your order has been placed successfully! Thank you for your purchase.
            </div>
        <?php endif; ?>

        <?php if (empty($cart_items)): ?>
            <div class="alert alert-info" role="alert">
                Your cart is empty. <a href="order.php" class="alert-link">Continue shopping</a>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tree</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>Ksh<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form action="cart.php" method="post" class="form-inline">
                                    <input type="hidden" name="tree_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control mr-2" style="width: 60px;">
                                    <button type="submit" name="update_quantity" class="btn btn-sm btn-secondary">Update</button>
                                </form>
                            </td>
                            <td>Ksh<?php echo number_format($item['subtotal'], 2); ?></td>
                            <td>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="tree_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="remove_from_cart" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total:</th>
                        <th>Ksh<?php echo number_format($total_price, 2); ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>

            <div class="text-right mt-4">
                <a href="order.php" class="btn btn-secondary">Continue Shopping</a>
                <form action="placeorder.php" method="post" class="d-inline">
                    <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
                </form>
                <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    <?php endif; ?>
            </div>
           <!-- <div class="btn-group" role="group"style="margin-right:10px;">
    <a href="place_order.php" class="btn btn-primary">Place Order</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    <?php endif; ?>
</div>-->
        <?php endif; ?>
    </div>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>