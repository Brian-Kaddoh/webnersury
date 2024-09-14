<?php
session_start();
include_once('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=" . urlencode($_SERVER['PHP_SELF']));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $total_amount = 0;

    // Calculate total amount
    foreach ($_SESSION['cart'] as $tree_id => $quantity) {
        $query = "SELECT price FROM trees WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $tree_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tree = $result->fetch_assoc();
        $total_amount += $tree['price'] * $quantity;
    }

    // Insert order
    $query = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("id", $user_id, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Insert order items
    $query = "INSERT INTO order_items (order_id, tree_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    foreach ($_SESSION['cart'] as $tree_id => $quantity) {
        $tree_query = "SELECT price FROM trees WHERE id = ?";
        $tree_stmt = $con->prepare($tree_query);
        $tree_stmt->bind_param("i", $tree_id);
        $tree_stmt->execute();
        $tree_result = $tree_stmt->get_result();
        $tree = $tree_result->fetch_assoc();
        $price = $tree['price'];

        $stmt->bind_param("iiid", $order_id, $tree_id, $quantity, $price);
        $stmt->execute();
    }

    // Clear the cart
    $_SESSION['cart'] = array();

    // Redirect to thank you page
    header("Location: thank_you.php?order_id=" . $order_id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order - Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("includes/header.php"); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Place Your Order</h1>
        <form action="placeorder.php" method="post">
            <!-- Add any additional fields you want to collect for the order -->
            <button type="submit" class="btn btn-primary">Confirm Order</button>
        </form>
    </div>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>