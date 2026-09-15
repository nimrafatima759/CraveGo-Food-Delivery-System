<?php

// =====================================================
// CraveGo - Test User Insert
// Purpose: Test whether PHP can insert a user
//          into the MySQL 'users' table.
// =====================================================


// -----------------------------------------------------
// 1. Connect to the database
// -----------------------------------------------------
// database.php contains our MySQL connection.
// require_once makes sure the file is loaded only once.
require_once "config/database.php";


// -----------------------------------------------------
// 2. Test user data
// -----------------------------------------------------
// These are temporary values just for testing.
// Later, these values will come from a signup form.
$name = "Test User";
$email = "test@example.com";

// Never store passwords as plain text.
// password_hash() converts the password into a secure hash.
$password = password_hash("123456", PASSWORD_DEFAULT);


// -----------------------------------------------------
// 3. Create SQL INSERT query
// -----------------------------------------------------
// INSERT is used to add a new record/row to a table.
//
// The ? placeholders will be replaced with our actual
// values safely using bind_param() below.
$sql = "INSERT INTO users (name, email, password)
        VALUES (?, ?, ?)";


// -----------------------------------------------------
// 4. Prepare the SQL query
// -----------------------------------------------------
// prepare() prepares the SQL statement before execution.
// This is safer than directly putting user input into SQL.
$stmt = $conn->prepare($sql);


// -----------------------------------------------------
// 5. Attach our values to the placeholders
// -----------------------------------------------------
// "sss" means:
// s = string (name)
// s = string (email)
// s = string (password)
$stmt->bind_param("sss", $name, $email, $password);


// -----------------------------------------------------
// 6. Execute the INSERT query
// -----------------------------------------------------
// execute() sends the prepared query to MySQL.
if ($stmt->execute()) {

    // If successful, this message will appear in the browser.
    echo "User inserted successfully!";

} else {

    // If something goes wrong, show the error.
    echo "Error: " . $stmt->error;
}


// -----------------------------------------------------
// 7. Close the statement and database connection
// -----------------------------------------------------
// We no longer need them after the query is finished.
$stmt->close();
$conn->close();
?>
