<?php
session_start();

$message = "";

if (count($_POST) > 0) {
    // Create a database connection
    $con = mysqli_connect('localhost', 'root', '', 'friend') or die('Unable To connect');
    
    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT id, name, password FROM login_user WHERE user_name = ?");
    $stmt->bind_param('s', $_POST['user_name']);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if a user exists with that username
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($_POST['password'], $hashed_password)) {
            // Set session variables if login is successful
            $_SESSION["id"] = $id;
            $_SESSION["name"] = $name;
        } else {
            $message = "Invalid Username or Password!";
        }
    } else {
        $message = "Invalid Username or Password!";
    }

    $stmt->close();
    mysqli_close($con);
}

// Redirect to index.php if the user is logged in
if (isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}
?>

