<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_name"])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();  // Stop further code execution
}
?>
<html>
<head>
<title>User Login</title>
</head>
<body>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>.</h2>
<p>Click here to <a href="logout.php" title="Logout">Logout</a>.</p>

</body>
</html>
