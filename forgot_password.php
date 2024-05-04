<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <p>Please enter your email address below. We'll send you instructions on how to reset your password.</p>
    <form action="reset_password.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>
