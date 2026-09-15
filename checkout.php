<?php

// =====================================================
// CraveGo - Checkout Page
// Purpose:
// Customer ki delivery information lena
// aur order place karne ke liye form provide karna.
// =====================================================

session_start();


// -----------------------------------------------------
// Agar user login hai to uski information automatically
// session se mil jayegi.
// -----------------------------------------------------

$userName = $_SESSION["user_name"] ?? "";
$userEmail = $_SESSION["user_email"] ?? "";

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

    <title>Checkout - CraveGo</title>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >


    <!-- Main CSS -->
    <link
        rel="stylesheet"
        href="css/style.css"
    >
     <link rel="stylesheet" href="css/style.css">
</head>


<body>


    <!-- =====================================================
         NAVBAR
         ===================================================== -->

    <header class="navbar">


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

            <span
                class="cart-count"
                id="cart-items-count"
            >
                0
            </span>

        </a>

    </header>



    <!-- =====================================================
         CHECKOUT HERO
         ===================================================== -->

    <section class="checkout-hero">

        <div class="checkout-hero-content">


            <span class="section-label">

                <i class="fa-solid fa-credit-card"></i>

                CHECKOUT

            </span>


            <h1>

                Complete Your Order

            </h1>


            <p>

                Enter your delivery information
                and place your order.

            </p>

        </div>

    </section>



    <!-- =====================================================
         CHECKOUT SECTION
         ===================================================== -->

    <section class="checkout-section">

        <div class="checkout-container">


            <!-- =================================================
                 CUSTOMER INFORMATION
                 ================================================= -->

            <div class="checkout-form-wrapper">


                <!-- Heading -->
                <div class="checkout-heading">

                    <span class="section-label">

                        <i class="fa-solid fa-location-dot"></i>

                        DELIVERY INFORMATION

                    </span>


                    <h2>

                        Where should we deliver?

                    </h2>

                </div>



                <!-- =================================================
                     CHECKOUT FORM
                     ================================================= -->

                <form id="checkout-form" onsubmit="placeOrder(event)">


                    <!-- Customer Name -->
                    <div class="form-group">

                        <label for="customer-name">

                            Full Name

                        </label>


                        <input
                            type="text"
                            id="customer-name"
                            name="customer_name"
                            value="<?php echo htmlspecialchars($userName); ?>"
                            placeholder="Enter your full name"
                            required
                        >

                    </div>



                    <!-- Customer Email -->
                    <div class="form-group">

                        <label for="customer-email">

                            Email Address

                        </label>


                        <input
                            type="email"
                            id="customer-email"
                            name="customer_email"
                            value="<?php echo htmlspecialchars($userEmail); ?>"
                            placeholder="Enter your email address"
                            required
                        >

                    </div>



                    <!-- Phone -->
                    <div class="form-group">

                        <label for="customer-phone">

                            Phone Number

                        </label>


                        <input
                            type="tel"
                            id="customer-phone"
                            name="phone"
                            placeholder="03XX-XXXXXXX"
                            required
                        >

                    </div>



                    <!-- Address -->
                    <div class="form-group">

                        <label for="customer-address">

                            Delivery Address

                        </label>


                        <textarea
                            id="customer-address"
                            name="address"
                            rows="5"
                            placeholder="Enter your complete delivery address"
                            required
                        ></textarea>

                    </div>



                    <!-- Payment Method -->
                    <div class="form-group">

                        <label>

                            Payment Method

                        </label>


                        <div class="payment-option">


                            <input
                                type="radio"
                                id="cod"
                                name="payment_method"
                                value="Cash on Delivery"
                                checked
                            >


                            <label for="cod">

                                <i class="fa-solid fa-money-bill-wave"></i>

                                Cash on Delivery

                            </label>

                        </div>

                    </div>



                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="checkout-submit-btn"
                        id="place-order-btn"
                    >

                        <i class="fa-solid fa-check"></i>

                        Place Order

                    </button>



                    <!-- Message -->
                    <div
                        id="checkout-message"
                        class="checkout-message"
                    ></div>


                </form>

            </div>



            <!-- =================================================
                 ORDER SUMMARY
                 ================================================= -->

            <aside class="checkout-summary">


                <!-- Heading -->
                <div class="checkout-heading">

                    <span class="section-label">

                        <i class="fa-solid fa-receipt"></i>

                        ORDER SUMMARY

                    </span>


                    <h2>

                        Your Order

                    </h2>

                </div>



                <!-- Cart Items -->
                <div id="checkout-items">

                    <!-- JavaScript yahan items show karega -->

                </div>



                <!-- Summary Details -->
                <div class="checkout-summary-details">


                    <!-- Subtotal -->
                    <div>

                        <span>
                            Subtotal
                        </span>


                        <strong id="checkout-subtotal">

                            Rs. 0.00

                        </strong>

                    </div>



                    <!-- Delivery -->
                    <div>

                        <span>
                            Delivery Fee
                        </span>


                        <strong id="checkout-delivery">

                            Rs. 0.00

                        </strong>

                    </div>



                    <!-- Total -->
                    <div class="checkout-total">

                        <span>
                            Total
                        </span>


                        <strong id="checkout-total">

                            Rs. 0.00

                        </strong>

                    </div>

                </div>

            </aside>


        </div>

    </section>


 <!-- =====================================================
         JavaScript
         ===================================================== -->
    


   <script>

let cart =
    JSON.parse(localStorage.getItem("cravego_cart")) || [];

const checkoutForm =
    document.getElementById("checkout-form");

const checkoutItems =
    document.getElementById("checkout-items");

const checkoutSubtotal =
    document.getElementById("checkout-subtotal");

const checkoutDelivery =
    document.getElementById("checkout-delivery");

const checkoutTotal =
    document.getElementById("checkout-total");

const checkoutMessage =
    document.getElementById("checkout-message");

const placeOrderButton =
    document.getElementById("place-order-btn");


// ===============================
// SHOW CART ITEMS
// ===============================

function displayCheckoutItems() {

    if (cart.length === 0) {

        checkoutItems.innerHTML =
            "<p>Your cart is empty.</p>";

        return;
    }

    checkoutItems.innerHTML = "";

    cart.forEach(item => {

        const itemElement =
            document.createElement("div");

        itemElement.className =
            "checkout-item";

        itemElement.innerHTML = `
            <div>
                <strong>${item.name}</strong>
                <span>Qty: ${item.quantity}</span>
            </div>

            <strong>
                Rs.
                ${(Number(item.price) * Number(item.quantity)).toFixed(2)}
            </strong>
        `;

        checkoutItems.appendChild(itemElement);

    });
}


// ===============================
// CALCULATE TOTAL
// ===============================

function calculateCheckoutTotal() {

    let subtotal = 0;

    cart.forEach(item => {

        subtotal +=
            Number(item.price) *
            Number(item.quantity);

    });

    const deliveryFee =
        cart.length > 0 ? 150 : 0;

    const total =
        subtotal + deliveryFee;

    checkoutSubtotal.textContent =
        "Rs. " + subtotal.toFixed(2);

    checkoutDelivery.textContent =
        "Rs. " + deliveryFee.toFixed(2);

    checkoutTotal.textContent =
        "Rs. " + total.toFixed(2);

    return total;
}


// ===============================
// PLACE ORDER
// ===============================

function placeOrder(event) {

    // Browser ka normal GET submission STOP
    event.preventDefault();

    console.log("Place Order function running!");

    if (cart.length === 0) {

        checkoutMessage.textContent =
            "Your cart is empty.";

        return false;
    }

    const formData =
        new FormData(checkoutForm);

    const orderData = {

        customer_name:
            formData.get("customer_name"),

        customer_email:
            formData.get("customer_email"),

        phone:
            formData.get("phone"),

        address:
            formData.get("address"),

        payment_method:
            formData.get("payment_method"),

        total_amount:
            calculateCheckoutTotal(),

        items:
            cart
    };


    placeOrderButton.disabled = true;

    placeOrderButton.innerHTML =
        "Placing Order...";

    checkoutMessage.textContent =
        "Please wait...";


    // ===============================
    // SEND ORDER TO PHP API
    // ===============================

    fetch("api/orders.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body:
            JSON.stringify(orderData)

    })

    .then(response => response.json())

    .then(result => {

        console.log("Order response:", result);

        if (result.success) {

            // Cart clear
            localStorage.removeItem(
                "cravego_cart"
            );

            // Confirmation page
            window.location.href =
                "confirmation.php?order_id=" +
                result.order_id;

        } else {

            checkoutMessage.textContent =
                result.message ||
                "Unable to place order.";

            placeOrderButton.disabled =
                false;

            placeOrderButton.innerHTML =
                "Place Order";
        }

    })

    .catch(error => {

        console.error(
            "Checkout error:",
            error
        );

        checkoutMessage.textContent =
            "Something went wrong. Please try again.";

        placeOrderButton.disabled =
            false;

        placeOrderButton.innerHTML =
            "Place Order";

    });

    return false;
}


// ===============================
// PAGE LOAD
// ===============================

displayCheckoutItems();

calculateCheckoutTotal();

    </script>


</body>

</html>