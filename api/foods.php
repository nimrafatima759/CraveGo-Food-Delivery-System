<?php

// =====================================================
// CraveGo - Foods API
// Purpose:
// MySQL database se food items ka data lena
// aur JSON format mein frontend ko return karna.
// =====================================================


// -----------------------------------------------------
// Database connection file include kar rahe hain
// -----------------------------------------------------
require_once "../config/database.php";


// -----------------------------------------------------
// Response ka format JSON set kar rahe hain
// -----------------------------------------------------
header("Content-Type: application/json");


// -----------------------------------------------------
// Foods table se required information fetch karna
//
// JOIN ka use is liye kiya hai taake:
// foods table se food data
// categories table se category name
// restaurants table se restaurant name
// dono ek hi API response mein mil jayein.
// -----------------------------------------------------
$sql = "
    SELECT
        foods.id,
        foods.name,
        foods.description,
        foods.price,
        foods.image,
        foods.category_id,
        categories.name AS category_name,
        foods.restaurant_id,
        restaurants.name AS restaurant_name

    FROM foods

    INNER JOIN categories
        ON foods.category_id = categories.id

    INNER JOIN restaurants
        ON foods.restaurant_id = restaurants.id

    ORDER BY foods.id DESC
";


// -----------------------------------------------------
// SQL query execute karna
// -----------------------------------------------------
$result = $conn->query($sql);


// -----------------------------------------------------
// Empty array create kar rahe hain
// Ismein foods ka data store hoga.
// -----------------------------------------------------
$foods = [];


// -----------------------------------------------------
// Agar query successful hai aur data available hai
// to har row ko array mein add karenge.
// -----------------------------------------------------
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $foods[] = $row;
    }
}


// -----------------------------------------------------
// Foods ka data JSON format mein return karna
// -----------------------------------------------------
echo json_encode($foods);


// -----------------------------------------------------
// Database connection close karna
// -----------------------------------------------------
$conn->close();

?>