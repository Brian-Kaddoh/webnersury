<?php
session_start();
include_once('includes/config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch dashboard data
$query = "SELECT 
    COUNT(*) AS total_orders,
    COUNT(CASE WHEN status = 'pending' THEN 1 END) AS pending_orders,
    COUNT(CASE WHEN status = 'processing' THEN 1 END) AS processing_orders,
    COUNT(CASE WHEN status = 'delivered' THEN 1 END) AS delivered_orders,
    COUNT(CASE WHEN status = 'cancelled' THEN 1 END) AS cancelled_orders
FROM orders";
$result = mysqli_query($con, $query);
$order_data = mysqli_fetch_assoc($result);

// Fetch inquiries count
$query = "SELECT COUNT(*) AS total_inquiries FROM inquiries";
$result = mysqli_query($con, $query);
$inquiry_data = mysqli_fetch_assoc($result);

// Fetch feedback count
$query = "SELECT COUNT(*) AS total_feedback FROM feedback";
$result = mysqli_query($con, $query);
$feedback_data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
        }
        .wrapper {
            display: flex;
            width: 100%;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #2c3136;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }
        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color: #fff;
        }
        #sidebar ul li a:hover {
            background: #2c3136;
        }
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }
        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Admin Panel</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#ordersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                    <ul class="collapse list-unstyled" id="ordersSubmenu">
                        <li>
                            <a href="admin_orders.php?status=pending">Pending Orders</a>
                        </li>
                        <li>
                            <a href="admin_orders.php?status=processing">Processing Orders</a>
                        </li>
                        <li>
                            <a href="admin_orders.php?status=delivered">Delivered Orders</a>
                        </li>
                        <li>
                            <a href="admin_orders.php?status=cancelled">Cancelled Orders</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="admin_inquiries.php"><i class="fas fa-question-circle"></i> Inquiries</a>
                </li>
                <li>
                    <a href="admin_feedback.php"><i class="fas fa-comments"></i> Feedback</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <div class="ml-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> Admin
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="admin_change_password.php">Change Password</a>
                                <a class="dropdown-item" href="admin_add_admin.php">Add Admin</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Dashboard Content -->
            <h2 class="mb-4">Dashboard</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Orders</h5>
                            <p class="card-text display-4"><?php echo $order_data['total_orders']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <p class="card-text display-4"><?php echo $order_data['pending_orders']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Processing Orders</h5>
                            <p class="card-text display-4"><?php echo $order_data['processing_orders']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Delivered Orders</h5>
                            <p class="card-text display-4"><?php echo $order_data['delivered_orders']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Cancelled Orders</h5>
                            <p class="card-text display-4"><?php echo $order_data['cancelled_orders']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Inquiries</h5>
                            <p class="card-text display-4"><?php echo $inquiry_data['total_inquiries']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Feedback</h5>
                            <p class="card-text display-4"><?php echo $feedback_data['total_feedback']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>