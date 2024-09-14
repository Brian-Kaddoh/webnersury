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
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $comment = mysqli_real_escape_string($con, $_POST['comment']);

    $query = "INSERT INTO feedbackuser (user_id, rating, comment) VALUES ('$user_id', '$rating', '$comment')";
    if (mysqli_query($con, $query)) {
        $success_message = "Feedback submitted successfully!";
    } else {
        $error_message = "Error submitting feedback. Please try again.";
    }
}

// Fetch existing feedback
$query = "SELECT f.*, u.username FROM feedbackuser f JOIN users u ON f.user_id = u.user_id ORDER BY f.created_at DESC";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("includes/header.php"); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Feedback</h1>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <h2>Submit Feedback</h2>
                <form action="feedback.php" method="post">
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select class="form-control" id="rating" name="rating" required>
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Very Good</option>
                            <option value="3">3 - Good</option>
                            <option value="2">2 - Fair</option>
                            <option value="1">1 - Poor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Recent Feedback</h2>
                <?php while ($feedback = mysqli_fetch_assoc($result)): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $feedback['username']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Rating: <?php echo $feedback['rating']; ?>/5</h6>
                            <p class="card-text"><?php echo $feedback['comment']; ?></p>
                            <small class="text-muted"><?php echo date('F j, Y, g:i a', strtotime($feedback['created_at'])); ?></small>
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