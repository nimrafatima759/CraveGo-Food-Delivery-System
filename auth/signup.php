<?php

// =====================================================
// CraveGo - User Signup
// Purpose: Register a new user and save their account
// information in the MySQL 'users' table.
// =====================================================


// -----------------------------------------------------
// 1. Connect to the database
// -----------------------------------------------------
require_once "../config/database.php";


// -----------------------------------------------------
// 2. Check whether the signup form was submitted
// -----------------------------------------------------
// $_SERVER["REQUEST_METHOD"] tells us how the page
// was accessed.
//
// POST means the user submitted the signup form.
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    // -------------------------------------------------
    // 3. Get data submitted by the user
    // -------------------------------------------------
    // trim() removes unnecessary spaces.
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];


    // -------------------------------------------------
    // 4. Basic validation
    // -------------------------------------------------
    if (empty($name) || empty($email) || empty($password)) {

        echo "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo "Please enter a valid email address.";

    } else {


        // ---------------------------------------------
        // 5. Check if email already exists
        // ---------------------------------------------
        // We don't want two accounts with the same email.
        $check_sql = "SELECT id FROM users WHERE email = ?";

        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();

        $result = $check_stmt->get_result();


        if ($result->num_rows > 0) {

            // Email already exists.
            echo "An account with this email already exists.";

        } else {


            // -----------------------------------------
            // 6. Hash the password
            // -----------------------------------------
            // We NEVER store the user's actual password.
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            // -----------------------------------------
            // 7. Insert the new user into MySQL
            // -----------------------------------------
            $sql = "INSERT INTO users (name, email, password)
                    VALUES (?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "sss",
                $name,
                $email,
                $hashed_password
            );


            // -----------------------------------------
            // 8. Execute the INSERT query
            // -----------------------------------------
            if ($stmt->execute()) {

                echo "Account created successfully!";

            } else {

                echo "Something went wrong. Please try again.";
            }


            // Close INSERT statement
            $stmt->close();
        }


        // Close email-check statement
        $check_stmt->close();
    }
}


// -----------------------------------------------------
// 9. Close database connection
// -----------------------------------------------------
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up - CraveGo</title>
            <!-- Main CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
>
</head>

<body class="auth-page">

    <main class="auth-container">

        <div class="auth-card">

            <a href="../index.php" class="auth-logo">
                <i class="fa-solid fa-utensils"></i>
                <span>Crave<span>Go</span></span>
            </a>

            <div class="auth-heading">
                <span>GET STARTED</span>
                <h1>Create Your <strong>Account</strong></h1>
                <p>Join CraveGo and start ordering delicious meals.</p>
            </div>


            <form action="" method="POST" class="auth-form">

                <div class="auth-field">
                    <label for="name">Full Name</label>

                    <div class="auth-input">
                        <i class="fa-solid fa-user"></i>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter your full name"
                            required
                        >
                    </div>
                </div>


                <div class="auth-field">
                    <label for="email">Email Address</label>

                    <div class="auth-input">
                        <i class="fa-solid fa-envelope"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                        >
                    </div>
                </div>


                <div class="auth-field">
                    <label for="password">Password</label>

                    <div class="auth-input">
                        <i class="fa-solid fa-lock"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Create a password"
                            required
                        >
                    </div>
                </div>


                <button type="submit" class="auth-submit">
                    Create Account
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>


            <p class="auth-switch">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

            <a href="../index.php" class="auth-back">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Home
            </a>

        </div>

    </main>

</body>
</html>