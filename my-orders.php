<?php
// =====================================================
// CraveGo - My Orders
// Purpose:
// Logged-in user ke previous orders display karna.
// User ID ya email dono ke through orders find honge.
// =====================================================

session_start();

// Database connection
require_once "config/database.php";

// -----------------------------------------------------
// Check Login
// -----------------------------------------------------
if (!isset($_SESSION["user_id"])) {
    header("Location: auth/login.php");
    exit;
}

// Logged-in user information
$userId = $_SESSION["user_id"];
$userEmail = $_SESSION["user_email"];

// -----------------------------------------------------
// Get User Orders
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
    WHERE customer_email = ?
    ORDER BY id DESC
";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $userEmail);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Orders | CraveGo</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

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

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "DM Sans", sans-serif;
            background: #fffaf5;
            color: #2d1f1a;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            background: #ffffff;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee3da;
        }

        .logo {
            text-decoration: none;
            font-family: "Playfair Display", serif;
            font-size: 28px;
            font-weight: 700;
            color: #d35400;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a {
            text-decoration: none;
            color: #3d302a;
            font-size: 15px;
            font-weight: 600;
        }

        .nav-links a:hover {
            color: #d35400;
        }

        .logout-btn {
            background: #d35400;
            color: white !important;
            padding: 10px 17px;
            border-radius: 8px;
        }

        /* =========================
           HERO
        ========================= */

        .orders-hero {
            text-align: center;
            padding: 65px 20px 45px;
            background: #fff3e8;
        }

        .orders-hero h1 {
            font-family: "Playfair Display", serif;
            font-size: 44px;
            margin-bottom: 10px;
            color: #2d1f1a;
        }

        .orders-hero p {
            color: #76675f;
            font-size: 16px;
        }

        /* =========================
           ORDERS SECTION
        ========================= */

        .orders-section {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
        }

        .section-title {
            font-family: "Playfair Display", serif;
            font-size: 30px;
            margin-bottom: 25px;
        }

        /* =========================
           ORDER CARD
        ========================= */

        .order-card {
            background: #ffffff;
            border: 1px solid #eadfd7;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(60, 35, 20, 0.06);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding-bottom: 18px;
            border-bottom: 1px solid #eee3da;
        }

        .order-id {
            font-size: 18px;
            font-weight: 700;
        }

        .order-date {
            color: #806f66;
            font-size: 14px;
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            padding-top: 20px;
        }

        .detail-box {
            background: #fffaf5;
            border-radius: 10px;
            padding: 15px;
        }

        .detail-label {
            display: block;
            color: #806f66;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 15px;
            font-weight: 600;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            background: #fff0df;
            color: #c75a00;
            font-size: 13px;
            font-weight: 700;
        }

        /* =========================
           TOTAL
        ========================= */

        .order-total {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #eee3da;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 16px;
            font-weight: 600;
        }

        .total-price {
            font-size: 22px;
            font-weight: 700;
            color: #d35400;
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .empty-orders {
            background: #ffffff;
            border: 1px solid #eadfd7;
            border-radius: 16px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(60, 35, 20, 0.05);
        }

        .empty-orders i {
            font-size: 48px;
            color: #d9a77d;
            margin-bottom: 18px;
        }

        .empty-orders h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .empty-orders p {
            color: #76675f;
            margin-bottom: 25px;
        }

        .menu-btn {
            display: inline-block;
            text-decoration: none;
            background: #d35400;
            color: #ffffff;
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: 600;
        }

        .menu-btn:hover {
            background: #b94700;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            margin-top: 70px;
            background: #2d1f1a;
            color: #ffffff;
            text-align: center;
            padding: 30px 20px;
        }

        footer p {
            color: #d8ccc5;
            font-size: 14px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .navbar {
                padding: 16px 5%;
            }

            .nav-links {
                gap: 12px;
            }

            .nav-links a {
                font-size: 13px;
            }

            .orders-hero h1 {
                font-size: 34px;
            }

            .orders-section {
                width: 92%;
            }

            .order-details {
                grid-template-columns: 1fr;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

        }

    </style>

</head>

<body>

    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="navbar">

        <a href="index.php" class="logo">
            CraveGo
        </a>

        <div class="nav-links">

            <a href="index.php">
                Home
            </a>

            <a href="menu.html">
                Menu
            </a>

            <a href="cart.html">
                Cart
            </a>

            <a href="dashboard.php">
                Dashboard
            </a>

            <a href="auth/logout.php" class="logout-btn">
                Logout
            </a>

        </div>

    </nav>


    <!-- =========================
         HERO
    ========================= -->

    <section class="orders-hero">

        <h1>Your Orders</h1>

        <p>
            View your previous CraveGo orders.
        </p>

    </section>


    <!-- =========================
         ORDERS
    ========================= -->

    <section class="orders-section">

        <h2 class="section-title">
            Previous Orders
        </h2>


        <?php if ($result->num_rows > 0): ?>

            <?php while ($order = $result->fetch_assoc()): ?>

                <div class="order-card">

                    <div class="order-header">

                        <div>

                            <div class="order-id">
                                Order #<?php echo htmlspecialchars($order["id"]); ?>
                            </div>

                            <div class="order-date">
                                <?php echo htmlspecialchars($order["created_at"]); ?>
                            </div>

                        </div>

                        <span class="status">
                            <?php echo htmlspecialchars($order["order_status"]); ?>
                        </span>

                    </div>


                    <div class="order-details">

                        <div class="detail-box">

                            <span class="detail-label">
                                Customer Name
                            </span>

                            <span class="detail-value">
                                <?php echo htmlspecialchars($order["customer_name"]); ?>
                            </span>

                        </div>


                        <div class="detail-box">

                            <span class="detail-label">
                                Email
                            </span>

                            <span class="detail-value">
                                <?php echo htmlspecialchars($order["customer_email"]); ?>
                            </span>

                        </div>


                        <div class="detail-box">

                            <span class="detail-label">
                                Phone
                            </span>

                            <span class="detail-value">
                                <?php echo htmlspecialchars($order["phone"]); ?>
                            </span>

                        </div>


                        <div class="detail-box">

                            <span class="detail-label">
                                Payment Method
                            </span>

                            <span class="detail-value">
                                <?php echo htmlspecialchars($order["payment_method"]); ?>
                            </span>

                        </div>


                        <div class="detail-box">

                            <span class="detail-label">
                                Delivery Address
                            </span>

                            <span class="detail-value">
                                <?php echo htmlspecialchars($order["address"]); ?>
                            </span>

                        </div>

                    </div>


                    <div class="order-total">

                        <span class="total-label">
                            Order Total
                        </span>

                        <span class="total-price">
                            Rs. <?php echo number_format($order["total_amount"], 2); ?>
                        </span>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="empty-orders">

                <i class="fa-solid fa-receipt"></i>

                <h3>
                    No Orders Yet
                </h3>

                <p>
                    You have not placed any orders yet.
                </p>

                <a href="menu.html" class="menu-btn">
                    Explore Menu
                </a>

            </div>

        <?php endif; ?>

    </section>


    <!-- =========================
         FOOTER
    ========================= -->

    <footer>

        <p>
            © 2026 CraveGo. All rights reserved.
        </p>

    </footer>


<?php

// Close statement and database connection
$stmt->close();
$conn->close();

?>

</body>

</html>
