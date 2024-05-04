<?php
// Include the database connection file
include_once 'db_connection.php';

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username is an email
$isEmail = filter_var($username, FILTER_VALIDATE_EMAIL);

// Construct SQL query based on whether the username is an email or not
if ($isEmail) {
    $sql = "SELECT * FROM users WHERE email = '$username'";
} else {
    $sql = "SELECT * FROM users WHERE username = '$username'";
}

$result = mysqli_query($conn, $sql);

// Check if user exists
if (mysqli_num_rows($result) == 1) {
    // User found, verify password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        // Password correct, log in the user
        echo "Login successful!";
        // Redirect to dashboard or another page
    } else {
        // Password incorrect
        echo "Incorrect password.";
    }
} else {
    // User not found
    echo "User not found.";
}

// Close database connection
mysqli_close($conn);
?>
