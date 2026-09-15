<?php

// =====================================================
// CraveGo - Restaurants API
// Purpose: Get restaurant data from MySQL database
//          and return it as JSON.
// =====================================================


// -----------------------------------------------------
// Database connection
// -----------------------------------------------------
// database.php mein $conn already create kiya gaya hai.
// Is file ko yahan include kar rahe hain.
require_once "../config/database.php";


// -----------------------------------------------------
// Set response type to JSON
// -----------------------------------------------------
// API browser/frontend ko JSON data return karegi.
header("Content-Type: application/json");


// -----------------------------------------------------
// Get restaurants from database
// -----------------------------------------------------
// Hum restaurants table ke tamam records retrieve kar rahe hain.
$sql = "SELECT id, name, description, address, phone, image
        FROM restaurants
        ORDER BY id DESC";


// Query execute karo
$result = $conn->query($sql);


// -----------------------------------------------------
// Create an empty array
// -----------------------------------------------------
// Is array mein database se milne wale restaurants
// store honge.
$restaurants = [];


// -----------------------------------------------------
// Check whether restaurants were found
// -----------------------------------------------------
if ($result && $result->num_rows > 0) {

    // Har restaurant ko one-by-one read karo
    while ($row = $result->fetch_assoc()) {

        // Restaurant ko array mein add karo
        $restaurants[] = $row;
    }
}


// -----------------------------------------------------
// Return the data as JSON
// -----------------------------------------------------
// json_encode() PHP array ko JSON mein convert karta hai.
echo json_encode($restaurants);


// -----------------------------------------------------
// Close database connection
// -----------------------------------------------------
$conn->close();

?>