<?php

// =====================================================
// CraveGo - Order Confirmation
// Purpose:
// Successfully placed order ki details show karna.
// =====================================================

session_start();

require_once "config/database.php";


// -----------------------------------------------------
// Order ID URL se lena
// Example:
// confirmation.php?order_id=15
// -----------------------------------------------------

$orderId = isset($_GET["order_id"])
    ? (int) $_GET["order_id"]
    : 0;


// -----------------------------------------------------
// Agar Order ID nahi mili
// -----------------------------------------------------

if ($orderId <= 0) {

    die("Invalid order ID.");

}


// -----------------------------------------------------
// Order database se fetch karna
// -----------------------------------------------------

$sql = "
    SELECT
        id,
        customer_name,
        customer_email,
        phone,
        address,
        total_amount,
        payment_method,
        order_status,
        created_at
    FROM orders
    WHERE id = ?
";


$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $orderId);

$stmt->execute();

$result = $stmt->get_result();


// -----------------------------------------------------
// Order exist karta hai ya nahi
// -----------------------------------------------------

if ($result->num_rows !== 1) {

    die("Order not found.");

}


$order = $result->fetch_assoc();

$stmt->close();

$conn->close();

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Settings -->
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Order Confirmed - CraveGo</title>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet"
    >


    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>


<body>


    <!-- =====================================================
         NAVBAR
         ===================================================== -->

    <nav class="navbar">


        <!-- Logo -->
        <a
            href="index.php"
            class="logo"
        >

            <i class="fa-solid fa-utensils"></i>

            <span>
                Crave<span>Go</span>
            </span>

        </a>


        <!-- Navigation -->
        <div class="nav-links">

            <a href="index.php">

                <i class="fa-solid fa-house"></i>

                Home

            </a>


            <a href="restaurants.html">

                <i class="fa-solid fa-store"></i>

                Restaurants

            </a>


            <a href="menu.html">

                <i class="fa-solid fa-utensils"></i>

                Menu

            </a>


            <a href="cart.html">

                <i class="fa-solid fa-cart-shopping"></i>

                Cart

            </a>


            <a href="dashboard.php">

                <i class="fa-solid fa-user"></i>

                Account

            </a>

        </div>


        <!-- Cart -->
        <a
            href="cart.html"
            class="cart-icon"
        >

            <i class="fa-solid fa-cart-shopping"></i>

            <span class="cart-count">
                0
            </span>

        </a>

    </nav>



    <!-- =====================================================
         CONFIRMATION SECTION
         ===================================================== -->

    <main class="confirmation-page">


        <div class="confirmation-container">


            <!-- Success Icon -->
            <div class="confirmation-icon">

                <i class="fa-solid fa-check"></i>

            </div>


            <!-- Main Message -->
            <span class="section-label">

                <i class="fa-solid fa-circle-check"></i>

                ORDER CONFIRMED

            </span>


            <h1>

                Thank You for Your Order!

            </h1>


            <p class="confirmation-message">

                Your order has been successfully placed.
                We're getting your delicious meal ready!

            </p>


            <!-- =================================================
                 ORDER INFORMATION
                 ================================================= -->

            <div class="confirmation-card">


                <!-- Order ID -->
                <div class="confirmation-row">

                    <span>

                        <i class="fa-solid fa-hashtag"></i>

                        Order ID

                    </span>


                    <strong>

                        #<?php echo $order["id"]; ?>

                    </strong>

                </div>


                <!-- Customer -->
                <div class="confirmation-row">

                    <span>

                        <i class="fa-solid fa-user"></i>

                        Customer

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $order["customer_name"]
                        );
                        ?>

                    </strong>

                </div>


                <!-- Email -->
                <div class="confirmation-row">

                    <span>

                        <i class="fa-solid fa-envelope"></i>

                        Email

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $order["customer_email"]
                        );
                        ?>

                    </strong>

                </div>


                <!-- Phone -->
                <div class="confirmation-row">

                    <span>

                        <i class="fa-solid fa-phone"></i>

                        Phone

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $order["phone"]
                        );
                        ?>

                    </strong>

                </div>


                <!-- Payment -->
                <div class="confirmation-row">

                    <span>

                        <i class="fa-solid fa-money-bill-wave"></i>

                        Payment

                    </span>


                    <strong>

                        <?php
                        echo htmlspecialchars(
                            $order["payment_method"]
                        );
                        ?>

                    </strong>

                </div>


                <!-- Status -->
                <div class="confirmation-row">

                    <span>

                        <i class="fa-solid fa-clock"></i>

                        Status

                    </span>


                    <strong class="order-status">

                        <?php
                        echo htmlspecialchars(
                            $order["order_status"]
                        );
                        ?>

                    </strong>

                </div>


                <!-- Total -->
                <div class="confirmation-total">

                    <span>

                        Total Amount

                    </span>


                    <strong>

                        Rs.
                        <?php
                        echo number_format(
                            $order["total_amount"],
                            2
                        );
                        ?>

                    </strong>

                </div>


            </div>



            <!-- Delivery Address -->
            <div class="confirmation-address">

                <span>

                    <i class="fa-solid fa-location-dot"></i>

                    Delivery Address

                </span>


                <p>

                    <?php
                    echo nl2br(
                        htmlspecialchars(
                            $order["address"]
                        )
                    );
                    ?>

                </p>

            </div>



            <!-- =================================================
                 ACTION BUTTONS
                 ================================================= -->

            <div class="confirmation-actions">


                <a
                    href="index.php"
                    class="confirmation-btn primary"
                >

                    <i class="fa-solid fa-house"></i>

                    Back to Home

                </a>


                <a
                    href="menu.html"
                    class="confirmation-btn secondary"
                >

                    <i class="fa-solid fa-utensils"></i>

                    Order More Food

                </a>


            </div>


        </div>

    </main>



    <!-- =====================================================
         FOOTER
         ===================================================== -->

    <footer class="footer">

        <div class="footer-bottom">

            © 2026 CraveGo. All Rights Reserved.

        </div>

    </footer>


</body>

</html>