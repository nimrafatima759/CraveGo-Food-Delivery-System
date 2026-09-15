<?php

// =====================================================
// CraveGo - Orders API
// Purpose:
// Checkout se received order information ko
// MySQL ke orders aur order_items tables mein save karna.
// =====================================================


// -----------------------------------------------------
// Database connection
// -----------------------------------------------------

require_once "../config/database.php";


// -----------------------------------------------------
// JSON response set karna
// -----------------------------------------------------

header("Content-Type: application/json");


// -----------------------------------------------------
// Sirf POST request allow karna
// -----------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);

    exit;
}


// -----------------------------------------------------
// JSON data receive karna
// -----------------------------------------------------

$jsonData = file_get_contents("php://input");


// JSON ko PHP array mein convert karna
$orderData = json_decode($jsonData, true);


// Agar JSON invalid ho
if (!$orderData) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid order data."
    ]);

    exit;
}


// -----------------------------------------------------
// Customer information lena
// -----------------------------------------------------

$customerName =
    trim($orderData["customer_name"] ?? "");

$customerEmail =
    trim($orderData["customer_email"] ?? "");

$phone =
    trim($orderData["phone"] ?? "");

$address =
    trim($orderData["address"] ?? "");

$paymentMethod =
    trim($orderData["payment_method"] ?? "Cash on Delivery");

$totalAmount =
    (float) ($orderData["total_amount"] ?? 0);

$items =
    $orderData["items"] ?? [];


// -----------------------------------------------------
// Basic validation
// -----------------------------------------------------

if (
    empty($customerName) ||
    empty($customerEmail) ||
    empty($phone) ||
    empty($address) ||
    empty($items)
) {

    echo json_encode([
        "success" => false,
        "message" => "Please provide all required information."
    ]);

    exit;
}


// Email validation
if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "message" => "Please enter a valid email address."
    ]);

    exit;
}


// -----------------------------------------------------
// Logged-in user ID
// -----------------------------------------------------

session_start();

$userId =
    $_SESSION["user_id"] ?? null;


// -----------------------------------------------------
// Database transaction start
// -----------------------------------------------------

$conn->begin_transaction();


try {


    // =================================================
    // STEP 1: Order create karna
    // =================================================

    $sql = "
        INSERT INTO orders
        (
            user_id,
            customer_name,
            customer_email,
            phone,
            address,
            total_amount,
            payment_method,
            order_status
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')
    ";


    $stmt =
        $conn->prepare($sql);


    // User ID NULL ho sakti hai
    if ($userId === null) {

        $stmt->bind_param(
            "issssds",
            $userId,
            $customerName,
            $customerEmail,
            $phone,
            $address,
            $totalAmount,
            $paymentMethod
        );

    }

    else {

        $stmt->bind_param(
            "issssds",
            $userId,
            $customerName,
            $customerEmail,
            $phone,
            $address,
            $totalAmount,
            $paymentMethod
        );

    }


    // Order insert karna
    $stmt->execute();


    // Newly created order ID
    $orderId =
        $conn->insert_id;


    $stmt->close();


    // =================================================
    // STEP 2: Order items save karna
    // =================================================

    $itemSql = "
        INSERT INTO order_items
        (
            order_id,
            food_id,
            food_name,
            price,
            quantity,
            subtotal
        )
        VALUES (?, ?, ?, ?, ?, ?)
    ";


    $itemStmt =
        $conn->prepare($itemSql);


    // Har cart item database mein save karna
    foreach ($items as $item) {

        $foodId =
            (int) ($item["id"] ?? 0);

        $foodName =
            $item["name"] ?? "";

        $price =
            (float) ($item["price"] ?? 0);

        $quantity =
            (int) ($item["quantity"] ?? 1);

        $subtotal =
            $price * $quantity;


        // Item insert
        $itemStmt->bind_param(
            "iisdid",
            $orderId,
            $foodId,
            $foodName,
            $price,
            $quantity,
            $subtotal
        );


        $itemStmt->execute();

    }


    $itemStmt->close();


    // =================================================
    // STEP 3: Transaction commit
    // =================================================

    $conn->commit();


    // =================================================
    // SUCCESS RESPONSE
    // =================================================

    echo json_encode([

        "success" => true,

        "message" =>
            "Order placed successfully!",

        "order_id" =>
            $orderId

    ]);

}


// -----------------------------------------------------
// Agar database error aaye
// -----------------------------------------------------

catch (Exception $error) {

    // Changes rollback karna
    $conn->rollback();


    echo json_encode([

        "success" => false,

        "message" =>
            "Unable to place order. Please try again."

    ]);

}


// -----------------------------------------------------
// Database connection close
// -----------------------------------------------------

$conn->close();

?>