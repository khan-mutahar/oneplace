<?php
// Start the session to store user data
session_start();
include 'CONFIG1.PHP';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to fetch the password for the given full_name
    $sql = "SELECT password FROM registration WHERE full_name='$full_name'";
    $result = $conn->query($sql);

    // Check if a user with that full_name exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['full_name'] = $full_name; // Store the full_name in session
            header("Location: WELCOME1.PHP");  // Redirect to a welcome page
            exit();
        } else {
            echo "Invalid password."; // Password doesn't match
        }
    } else {
        echo "No user found with that name."; // Full name doesn't exist in the database
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login2 </title>
    <link rel="stylesheet" href="/WD/MP/style p.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <img alt="Contact icon for login" height="150" src="contact.jpg" width="150" />
        </div>
        <div class="login-form">
            <h2>Member Login</h2>
            <form action="LOGIN1.PHP" method="post">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="full_name" placeholder="FULL NAME" required />
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <button class="login-button" type="submit">LOGIN</button>
                <div class="forgot-password">
                    <a href="#">Forgot Username / Password</a>
                </div>
                <div class="create-account">
                    <a href="REGISTER1.PHP">Create your Account</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
