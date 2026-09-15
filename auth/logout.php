<?php

// =====================================================
// CraveGo - User Logout
// Purpose: End the current user's login session.
// =====================================================


// -----------------------------------------------------
// Start the existing session
// -----------------------------------------------------
session_start();


// -----------------------------------------------------
// Remove all session variables
// -----------------------------------------------------
// User ki session mein stored information remove hogi.
session_unset();


// -----------------------------------------------------
// Destroy the session
// -----------------------------------------------------
// Current login session completely end ho jayegi.
session_destroy();


// -----------------------------------------------------
// Redirect the user to the login page
// -----------------------------------------------------
// logout.php aur login.php dono auth folder mein hain,
// isliye sirf "login.php" likhna enough hai.
header("Location: login.php");


// Redirect ke baad PHP ko further execute hone se rok do.
exit;

?>