<?php
session_start();
include_once('includes/config.php');

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle adding to cart
if (isset($_POST['add_to_cart'])) {
    $tree_id = $_POST['tree_id'];
    $quantity = $_POST['quantity'];
    
    if (isset($_SESSION['cart'][$tree_id])) {
        $_SESSION['cart'][$tree_id] += $quantity;
    } else {
        $_SESSION['cart'][$tree_id] = $quantity;
    }
    
    // Redirect to prevent form resubmission
    header("Location: order.php");
    exit();
}
// Search functionality
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
$where_clause = $search ? "WHERE name LIKE '%$search%'" : '';

// Fetch trees from the database
$trees_per_page = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $trees_per_page;

$query = "SELECT * FROM trees $where_clause LIMIT $offset, $trees_per_page";
$result = mysqli_query($con, $query);

// Count total number of trees
$total_trees_query = "SELECT COUNT(*) as total FROM trees $where_clause";
$total_trees_result = mysqli_query($con, $total_trees_query);
$total_trees = mysqli_fetch_assoc($total_trees_result)['total'];
$total_pages = ceil($total_trees / $trees_per_page);

// Calculate total items in cart
$cart_count = array_sum($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Trees - Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
       .tree-card {
            height: 100%;
        }
        .tree-image {
            height: 200px;
            object-fit: cover;
        }
        .search-cart-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-form {
            margin-right: 15px;
        }
        .cart-icon {
            font-size: 24px;
            color: #28a745;
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
        .action-buttons {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include("includes/header.php"); ?>

    <div class="container mt-5" style="margin-top:90px;">
        <h1 class="text-center mb-4">Order Trees</h1>
        
        <div class="action-buttons text-center">
            <a href="feedback.php" class="btn btn-primary mr-2">
                <i class="fas fa-comment"></i> Provide Feedback
            </a>
            <a href="inquiry.php" class="btn btn-info">
                <i class="fas fa-question-circle"></i> Submit Inquiry
            </a>
        </div>

        <div class="search-cart-container">
            <form class="form-inline search-form" action="order.php" method="get">
                <input class="form-control mr-sm-2" type="search" placeholder="Search trees" aria-label="Search" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a href="cart.php" class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count"><?php echo $cart_count; ?></span>
            </a>
        </div>
        
        <div class="row">
            <?php while ($tree = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-3 mb-4">
                    <div class="card tree-card">
                        <img src="<?php echo $tree['image_url']; ?>" class="card-img-top tree-image" alt="<?php echo $tree['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $tree['name']; ?></h5>
                            <p class="card-text"><?php echo substr($tree['description'], 0, 100) . '...'; ?></p>
                            <p class="card-text"><strong>Price: KSH<?php echo $tree['price']; ?></strong></p>
                            <form action="order.php" method="post">
                                <input type="hidden" name="tree_id" value="<?php echo $tree['id']; ?>">
                                <div class="form-group">
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                                </div>
                                <button type="submit" name="add_to_cart" class="btn btn-success btn-block">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php
                $start_page = max(1, $page - 2);
                $end_page = min($total_pages, $page + 2);

                for ($i = $start_page; $i <= $end_page; $i++):
                ?>
                    <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>