<?php
// Include your database configuration file
include_once('includes/config.php');

// Admin details
$username = 'BrianOkinyi';
$email = 'brian@gmail.com';
$password = 'Brian123';
$role = 'admin';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement
$sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";

// Create a prepared statement
$stmt = mysqli_prepare($con, $sql);

// Bind parameters to the prepared statement
mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $role);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    echo "Admin user created successfully";
} else {
    echo "Error: " . mysqli_error($con);
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>