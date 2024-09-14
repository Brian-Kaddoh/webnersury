<?php
// Database configuration
$servername = "localhost";  // Typically 'localhost' if your database is on the same server
$username = "root";         // Your database username
$password = "";             // Your database password (leave blank if none)
$dbname = "treesdb";        // The name of your database

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Optional: Set the character set to utf8 to support international characters
$con->set_charset("utf8");

// Now, the $con variable can be used in your PHP scripts to interact with the database.
?>