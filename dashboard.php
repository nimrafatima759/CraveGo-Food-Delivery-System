<?php

// =====================================================
// CraveGo - User Dashboard
// Purpose: Show dashboard only to logged-in users.
// =====================================================


// -----------------------------------------------------
// Start the session
// -----------------------------------------------------
// Login ke waqt humne session mein user ki information
// save ki thi. Yahan us session ko access kar rahe hain.
session_start();


// -----------------------------------------------------
// Check whether the user is logged in
// -----------------------------------------------------
// Agar "user_id" session mein nahi hai,
// iska matlab user login nahi hai.
if (!isset($_SESSION["user_id"])) {

    // User ko login page par bhej do
    header("Location: auth/login.php");

    // Redirect ke baad code ko stop kar do
    exit;
}


// -----------------------------------------------------
// Get logged-in user's information from the session
// -----------------------------------------------------
$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <!-- Responsive design ke liye -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - CraveGo</title>
    <!-- Main CSS -->
      <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Dashboard heading -->
    <h1>Welcome to CraveGo!</h1>


    <!-- Logged-in user's name -->
    <h2>
        Hello, <?php echo htmlspecialchars($user_name); ?> 👋
    </h2>


    <!-- User information -->
    <p>
        <strong>User ID:</strong>
        <?php echo $user_id; ?>
    </p>

    <p>
        <strong>Email:</strong>
        <?php echo htmlspecialchars($user_email); ?>
    </p>


    <!-- Logout button -->
    <a href="auth/logout.php">
        <button type="button">Logout</button>
    </a>

</body>

</html>