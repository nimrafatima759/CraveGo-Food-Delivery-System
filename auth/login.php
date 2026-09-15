<?php

// =====================================================
// CraveGo - User Login
// Purpose: Check the user's email and password,
//          then create a login session.
// =====================================================


// -----------------------------------------------------
// Start the session
// -----------------------------------------------------
// Session user ko login rakhne ke liye use hoti hai.
// IMPORTANT: session_start() HTML se pehle hona chahiye.
session_start();


// -----------------------------------------------------
// Connect to the database
// -----------------------------------------------------
require_once "../config/database.php";


// -----------------------------------------------------
// Check whether the login form was submitted
// -----------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get email and password from the form
    $email = trim($_POST["email"]);
    $password = $_POST["password"];


    // -------------------------------------------------
    // Basic validation
    // -------------------------------------------------
    if (empty($email) || empty($password)) {

        echo "Please enter your email and password.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo "Please enter a valid email address.";

    } else {


        // -------------------------------------------------
        // Find the user by email
        // -------------------------------------------------
        // Hum database se user ki id, name, email aur
        // hashed password retrieve kar rahe hain.
        //
        // ? ki wajah se prepared statement use ho raha hai.
        $sql = "SELECT id, name, email, password
                FROM users
                WHERE email = ?";


        $stmt = $conn->prepare($sql);

        // "s" means email ek string hai
        $stmt->bind_param("s", $email);

        // Query execute karo
        $stmt->execute();


        // Query ka result hasil karo
        $result = $stmt->get_result();


        // -------------------------------------------------
        // Check whether account exists
        // -------------------------------------------------
        if ($result->num_rows === 1) {

            // User ka data array mein convert karo
            $user = $result->fetch_assoc();


            // -------------------------------------------------
            // Verify password
            // -------------------------------------------------
            // Database mein password plain text mein nahi hai.
            // password_hash() ne usay hashed form mein save kiya tha.
            //
            // password_verify() entered password ko
            // database ke hash ke saath verify karta hai.
            if (password_verify($password, $user["password"])) {


                // -------------------------------------------------
                // Login successful
                // -------------------------------------------------

                // User ki ID session mein save karo
                $_SESSION["user_id"] = $user["id"];

                // User ka name session mein save karo
                $_SESSION["user_name"] = $user["name"];

                // User ka email session mein save karo
                $_SESSION["user_email"] = $user["email"];


                // Success message
                echo "Login successful!";


            } else {

                // Password incorrect hai
                echo "Incorrect email or password.";

            }

        } else {

            // Email database mein nahi mili
            echo "Incorrect email or password.";

        }


        // Statement close karo
        $stmt->close();
    }
}


// Database connection close karo
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Makes the page responsive on mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - CraveGo</title>
    <!-- Main CSS-->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <!-- Page heading -->
    <h1>Login to CraveGo</h1>

    <!--
        Login form

        method="POST":
        User ka email aur password securely form ke through
        isi page ke PHP code ko bheja jayega.

        action="":
        Form isi login.php page par submit hoga.
    -->
    <form action="" method="POST">

        <!-- Email field -->
        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            required
        >

        <br><br>

        <!-- Password field -->
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <br><br>

        <!-- Submit button -->
        <button type="submit">Login</button>

    </form>

</body>

</html>