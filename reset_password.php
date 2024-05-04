<?php
// Include the database connection file
include_once 'db_connection.php';

// Function to generate a random password
function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

// Retrieve form data
$email = $_POST['email'];

// Check if the email exists in the database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    // User found, generate new password or token
    $newPassword = generateRandomPassword(); // Generate a new random password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password

    // Update the user's password in the database
    $updateSql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
    if (mysqli_query($conn, $updateSql)) {
        // Send email with new password
        $to = $email;
        $subject = 'Your New Password';
        $message = 'Your new password is: ' . $newPassword;
        mail($to, $subject, $message);
        
        echo "An email with your new password has been sent to your email address.";
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
} else {
    // User not found
    echo "User not found.";
}

// Close database connection
mysqli_close($conn);
?>
