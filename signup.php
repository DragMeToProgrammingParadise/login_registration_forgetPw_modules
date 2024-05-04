<?php
// Include the database connection file
include_once 'db_connection.php';

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
    
}

// Function to check if username is unique
function isUsernameUnique($conn, $username) {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    return (mysqli_num_rows($result) == 0);
    
}

// Function to check if email is unique
function isEmailUnique($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return (mysqli_num_rows($result) == 0);
    
}

// Retrieve form data
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Validate email format
if (!validateEmail($email)) {
    die("Invalid email format.");
}

// Check if username is unique
if (!isUsernameUnique($conn, $username)) {
    die("Username already exists.");
}

// Check if email is unique
if (!isEmailUnique($conn, $email)) {
    die("Email already exists.");
}

// Insert user data into the database
$sql = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";
if (mysqli_query($conn, $sql)) {
    echo "Sign up successful!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
