<?php
// =====================================================
// CraveGo - Home Page
// =====================================================
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>CraveGo - Food Delivered With Love</title>

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
    <link
        rel="stylesheet"
        href="css/style.css"
    >

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


        <!-- Navigation Links -->

        <div class="nav-links">

            <a
                href="index.php"
                class="active"
            >
                <i class="fa-solid fa-house"></i>
                Home
            </a>


            <a href="restaurants.html">

                <i class="fa-solid fa-store"></i>
                Restaurants

            </a>


            <a href="menu.html">

                <i class="fa-solid fa-bowl-food"></i>
                Menu

            </a>


            <a href="#how-it-works">

                <i class="fa-solid fa-circle-info"></i>
                How It Works

            </a>


            <a href="dashboard.php">

                <i class="fa-solid fa-user"></i>
                Account

            </a>

        </div>


        <!-- Right Side Actions -->

        <div class="nav-actions">

            <a
                href="cart.html"
                class="cart-icon"
            >

                <i class="fa-solid fa-cart-shopping"></i>

                <span class="cart-count">
                    0
                </span>

            </a>


            <a
                href="auth/login.php"
                class="login-btn"
            >
                Login
            </a>

        </div>


        <!-- Mobile Menu Button -->

        <button
            class="menu-toggle"
            id="menu-toggle"
            type="button"
            aria-label="Open navigation menu"
        >

            <i class="fa-solid fa-bars"></i>

        </button>

    </nav>



    <!-- =====================================================
         HERO SECTION
         ===================================================== -->

    <section class="home-hero">


        <!-- Hero Text -->

        <div class="home-hero-content">


            <span class="hero-label">

                <i class="fa-solid fa-fire"></i>

                FAST • FRESH • DELICIOUS

            </span>


            <h1>

                Delicious Food,

                <span>
                    Delivered To You.
                </span>

            </h1>


            <p>

                Discover your favorite meals from the best
                restaurants around you and enjoy delicious
                food delivered right to your doorstep.

            </p>


            <!-- Hero Buttons -->

            <div class="hero-buttons">

                <a
                    href="restaurants.html"
                    class="primary-btn"
                >

                    Explore Restaurants

                    <i class="fa-solid fa-arrow-right"></i>

                </a>


                <a
                    href="#how-it-works"
                    class="secondary-btn"
                >

                    <i class="fa-solid fa-circle-play"></i>

                    How It Works

                </a>

            </div>


            <!-- Trust Information -->

            <div class="hero-trust">


                <!-- Rating -->

                <div class="trust-item">

                    <i class="fa-solid fa-star"></i>

                    <div>

                        <strong>
                            4.8/5
                        </strong>

                        <span>
                            Customer Rating
                        </span>

                    </div>

                </div>


                <!-- Restaurants -->

                <div class="trust-item">

                    <i class="fa-solid fa-store"></i>

                    <div>

                        <strong>
                            50+
                        </strong>

                        <span>
                            Restaurants
                        </span>

                    </div>

                </div>


                <!-- Delivery -->

                <div class="trust-item">

                    <i class="fa-solid fa-motorcycle"></i>

                    <div>

                        <strong>
                            Fast
                        </strong>

                        <span>
                            Delivery
                        </span>

                    </div>

                </div>


            </div>

        </div>



        <!-- Hero Image -->

        <div class="home-hero-image">


            <div class="hero-image-circle">

                <img
                    src="images/hero-food.jpg"
                    alt="Delicious food from CraveGo"
                >

            </div>


            <!-- Delivery Card -->

            <div class="floating-card floating-card-one">

                <i class="fa-solid fa-motorcycle"></i>

                <div>

                    <strong>
                        Fast Delivery
                    </strong>

                    <span>
                        At your doorstep
                    </span>

                </div>

            </div>


            <!-- Rating Card -->

            <div class="floating-card floating-card-two">

                <i class="fa-solid fa-star"></i>

                <div>

                    <strong>
                        4.8 Rating
                    </strong>

                    <span>
                        Loved by customers
                    </span>

                </div>

            </div>

        </div>

    </section>



    <!-- =====================================================
         CATEGORIES
         ===================================================== -->

    <section class="categories-section">


        <div class="section-heading">

            <span class="section-label">

                <i class="fa-solid fa-utensils"></i>

                WHAT ARE YOU CRAVING?

            </span>


            <h2>

                Explore Food

                <span>
                    Categories
                </span>

            </h2>


            <p>

                Choose what you're in the mood for and
                discover something delicious.

            </p>

        </div>



        <div class="category-grid">


            <a
                href="menu.html"
                class="category-card"
            >

                <div class="category-icon">

                    <i class="fa-solid fa-burger"></i>

                </div>

                <h3>
                    Burgers
                </h3>

                <span>
                    12+ Items
                </span>

            </a>



            <a
                href="menu.html"
                class="category-card"
            >

                <div class="category-icon">

                    <i class="fa-solid fa-pizza-slice"></i>

                </div>

                <h3>
                    Pizza
                </h3>

                <span>
                    15+ Items
                </span>

            </a>



            <a
                href="menu.html"
                class="category-card"
            >

                <div class="category-icon">

                    <i class="fa-solid fa-bowl-rice"></i>

                </div>

                <h3>
                    Pakistani
                </h3>

                <span>
                    20+ Items
                </span>

            </a>



            <a
                href="menu.html"
                class="category-card"
            >

                <div class="category-icon">

                    <i class="fa-solid fa-bowl-food"></i>

                </div>

                <h3>
                    Pasta
                </h3>

                <span>
                    10+ Items
                </span>

            </a>



            <a
                href="menu.html"
                class="category-card"
            >

                <div class="category-icon">

                    <i class="fa-solid fa-drumstick-bite"></i>

                </div>

                <h3>
                    BBQ
                </h3>

                <span>
                    18+ Items
                </span>

            </a>



            <a
                href="menu.html"
                class="category-card"
            >

                <div class="category-icon">

                    <i class="fa-solid fa-ice-cream"></i>

                </div>

                <h3>
                    Desserts
                </h3>

                <span>
                    14+ Items
                </span>

            </a>


        </div>

    </section>



    <!-- =====================================================
         POPULAR RESTAURANTS
         ===================================================== -->

    <section class="popular-section">


        <div class="section-heading">

            <span class="section-label">

                <i class="fa-solid fa-fire"></i>

                TOP PICKS FOR YOU

            </span>


            <h2>

                Popular

                <span>
                    Restaurants
                </span>

            </h2>


            <p>

                Explore some of the best places to order
                your favorite food.

            </p>

        </div>



        <!-- Dynamic Restaurant Cards -->

        <div
            class="home-restaurant-grid"
            id="home-restaurants"
        >

            <div class="home-loading">

                <i class="fa-solid fa-spinner fa-spin"></i>

                Loading restaurants...

            </div>

        </div>



        <div class="section-action">

            <a
                href="restaurants.html"
                class="outline-btn"
            >

                View All Restaurants

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    </section>



    <!-- =====================================================
         POPULAR DISHES
         ===================================================== -->

    <section
        class="popular-foods-section"
        id="popular-foods"
    >


        <div class="section-heading">

            <span class="section-label">

                <i class="fa-solid fa-utensils"></i>

                CUSTOMER FAVORITES

            </span>


            <h2>

                Popular

                <span>
                    Dishes
                </span>

            </h2>


            <p>

                Delicious dishes that our customers
                love the most.

            </p>

        </div>



        <!-- Dynamic Food Cards -->

        <div
            class="home-food-grid"
            id="home-foods"
        >

            <div class="home-loading">

                <i class="fa-solid fa-spinner fa-spin"></i>

                Loading dishes...

            </div>

        </div>


    </section>



    <!-- =====================================================
         HOW IT WORKS
         ===================================================== -->

    <section
        class="how-section"
        id="how-it-works"
    >


        <div class="section-heading">

            <span class="section-label">

                <i class="fa-solid fa-route"></i>

                SIMPLE & EASY

            </span>


            <h2>

                How CraveGo

                <span>
                    Works
                </span>

            </h2>


            <p>

                Ordering your favorite food has never
                been easier.

            </p>

        </div>



        <div class="steps-grid">


            <!-- Step 1 -->

            <div class="step-card">

                <div class="step-number">
                    01
                </div>

                <div class="step-icon">

                    <i class="fa-solid fa-store"></i>

                </div>

                <h3>
                    Choose a Restaurant
                </h3>

                <p>

                    Browse restaurants and discover
                    something delicious.

                </p>

            </div>



            <!-- Step 2 -->

            <div class="step-card">

                <div class="step-number">
                    02
                </div>

                <div class="step-icon">

                    <i class="fa-solid fa-bowl-food"></i>

                </div>

                <h3>
                    Pick Your Food
                </h3>

                <p>

                    Select your favorite dishes and
                    add them to your cart.

                </p>

            </div>



            <!-- Step 3 -->

            <div class="step-card">

                <div class="step-number">
                    03
                </div>

                <div class="step-icon">

                    <i class="fa-solid fa-cart-shopping"></i>

                </div>

                <h3>
                    Place Your Order
                </h3>

                <p>

                    Review your cart and provide your
                    delivery details.

                </p>

            </div>



            <!-- Step 4 -->

            <div class="step-card">

                <div class="step-number">
                    04
                </div>

                <div class="step-icon">

                    <i class="fa-solid fa-motorcycle"></i>

                </div>

                <h3>
                    Enjoy Your Meal
                </h3>

                <p>

                    Sit back and enjoy your delicious
                    food at your doorstep.

                </p>

            </div>


        </div>

    </section>



    <!-- =====================================================
         WHY CHOOSE CRAVEGO
         ===================================================== -->

    <section class="features-section">


        <div class="features-content">

            <span class="section-label">

                <i class="fa-solid fa-heart"></i>

                WHY CRAVEGO?

            </span>


            <h2>

                More Than Just

                <span>
                    Food Delivery
                </span>

            </h2>


            <p>

                We make ordering food simple, convenient
                and enjoyable from start to finish.

            </p>

        </div>



        <div class="features-grid">


            <!-- Feature 1 -->

            <div class="feature-card">

                <i class="fa-solid fa-bolt"></i>

                <h3>
                    Fast Delivery
                </h3>

                <p>

                    Get your favorite meals delivered
                    quickly and conveniently.

                </p>

            </div>



            <!-- Feature 2 -->

            <div class="feature-card">

                <i class="fa-solid fa-leaf"></i>

                <h3>
                    Fresh Food
                </h3>

                <p>

                    Discover delicious meals prepared
                    by trusted restaurants.

                </p>

            </div>



            <!-- Feature 3 -->

            <div class="feature-card">

                <i class="fa-solid fa-shield-halved"></i>

                <h3>
                    Secure Ordering
                </h3>

                <p>

                    Your account and order information
                    are handled securely.

                </p>

            </div>



            <!-- Feature 4 -->

            <div class="feature-card">

                <i class="fa-solid fa-headset"></i>

                <h3>
                    Easy Experience
                </h3>

                <p>

                    A simple and user-friendly ordering
                    experience for everyone.

                </p>

            </div>


        </div>

    </section>



    <!-- =====================================================
         CALL TO ACTION
         ===================================================== -->

    <section class="cta-section">


        <div class="cta-content">

            <span class="section-label">

                <i class="fa-solid fa-face-smile"></i>

                READY TO ORDER?

            </span>


            <h2>

                Your Next Favorite Meal

                <span>
                    Is Just a Click Away.
                </span>

            </h2>


            <p>

                Explore restaurants, discover delicious
                dishes and satisfy your cravings today.

            </p>


            <a
                href="restaurants.html"
                class="primary-btn"
            >

                Start Exploring

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    </section>



    <!-- =====================================================
         FOOTER
         ===================================================== -->

    <footer class="footer">


        <div class="footer-content">


            <!-- Brand -->

            <div class="footer-brand">

                <a
                    href="index.php"
                    class="logo"
                >

                    <i class="fa-solid fa-utensils"></i>

                    <span>
                        Crave<span>Go</span>
                    </span>

                </a>


                <p>

                    Delicious food, delivered with love.
                    Discover great food from restaurants
                    around you.

                </p>


                <div class="social-links">

                    <a
                        href="#"
                        aria-label="Facebook"
                    >

                        <i class="fa-brands fa-facebook-f"></i>

                    </a>


                    <a
                        href="#"
                        aria-label="Instagram"
                    >

                        <i class="fa-brands fa-instagram"></i>

                    </a>


                    <a
                        href="#"
                        aria-label="Twitter"
                    >

                        <i class="fa-brands fa-x-twitter"></i>

                    </a>

                </div>

            </div>



            <!-- Quick Links -->

            <div class="footer-column">

                <h3>
                    Quick Links
                </h3>


                <a href="index.php">
                    Home
                </a>


                <a href="restaurants.html">
                    Restaurants
                </a>


                <a href="menu.html">
                    Menu
                </a>


                <a href="#how-it-works">
                    How It Works
                </a>

            </div>



            <!-- Account -->

            <div class="footer-column">

                <h3>
                    Account
                </h3>


                <a href="auth/login.php">
                    Login
                </a>


                <a href="auth/signup.php">
                    Create Account
                </a>


                <a href="dashboard.php">
                    Dashboard
                </a>


                <a href="my-orders.php">
                    My Orders
                </a>

            </div>



            <!-- Contact -->

            <div class="footer-column">

                <h3>
                    Contact
                </h3>


                <span>

                    <i class="fa-solid fa-phone"></i>

                    0300-1234567

                </span>


                <span>

                    <i class="fa-solid fa-envelope"></i>

                    hello@cravego.com

                </span>


                <span>

                    <i class="fa-solid fa-location-dot"></i>

                    Pakistan

                </span>

            </div>


        </div>



        <!-- Copyright -->

        <div class="footer-bottom">

            <p>

                &copy; 2026 CraveGo.
                All rights reserved.

            </p>

        </div>

    </footer>



    <!-- =====================================================
         HOME PAGE JAVASCRIPT
         ===================================================== -->

    <script src="js/script.js"></script>


</body>

</html>