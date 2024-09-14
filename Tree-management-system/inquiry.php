<?php
session_start();
include_once('includes/config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $query = "INSERT INTO inquiries (user_id, subject, message) VALUES ('$user_id', '$subject', '$message')";
    if (mysqli_query($con, $query)) {
        $success_message = "Inquiry submitted successfully!";
    } else {
        $error_message = "Error submitting inquiry. Please try again.";
    }
}

// Fetch user's inquiries
$query = "SELECT * FROM inquiries WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries - Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("includes/header.php"); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Inquiries</h1>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <h2>Submit Inquiry</h2>
                <form action="inquiry.php" method="post">
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Inquiry</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Your Inquiries</h2>
                <?php while ($inquiry = mysqli_fetch_assoc($result)): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $inquiry['subject']; ?></h5>
                            <p class="card-text"><?php echo $inquiry['message']; ?></p>
                            <p class="card-text">
                                <small class="text-muted">Status: <?php echo ucfirst($inquiry['status']); ?></small>
                            </p>
                            <small class="text-muted"><?php echo date('F j, Y, g:i a', strtotime($inquiry['created_at'])); ?></small>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>