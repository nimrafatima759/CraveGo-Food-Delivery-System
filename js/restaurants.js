// =====================================================
// CraveGo - Restaurants JavaScript
// Purpose:
// 1. PHP API se restaurants ka data lena
// 2. Restaurant cards dynamically create karna
// 3. Mobile navigation menu ko control karna
// =====================================================


// =====================================================
// 1. API & PAGE ELEMENTS
// =====================================================


// PHP API ka address
const apiUrl = "api/restaurants.php";


// Restaurant cards ke container ko select karna
const restaurantList =
    document.getElementById("restaurant-list");


// Search input ko select karna
const restaurantSearch =
    document.getElementById("restaurant-search");


// Mobile hamburger button ko select karna
const menuToggle =
    document.getElementById("menu-toggle");


// Navigation links ko select karna
const navLinks =
    document.querySelector(".nav-links");


// =====================================================
// 2. LOAD RESTAURANTS FROM PHP API
// =====================================================


// PHP API ko request bhej rahe hain
fetch(apiUrl)

    // PHP se milne wale response ko JSON mein convert karna
    .then(response => response.json())

    // JSON data milne ke baad ye code chalega
    .then(restaurants => {


        // Purana loading message remove karna
        restaurantList.innerHTML = "";


        // Agar database mein koi restaurant nahi hai
        if (restaurants.length === 0) {

            restaurantList.innerHTML = `
                <p class="loading-message">
                    No restaurants found.
                </p>
            `;

            return;
        }


        // =================================================
        // 3. CREATE RESTAURANT CARDS
        // =================================================


        // Har restaurant ke liye ek card create karna
        restaurants.forEach(restaurant => {


            // New article element create karna
            const card = document.createElement("article");


            // Card ki CSS class
            card.className = "restaurant-card";


            // Restaurant card ka HTML
            card.innerHTML = `

                <!-- Restaurant image -->
                <div class="restaurant-image">

                    <img
                        src="images/${restaurant.image}"
                        alt="${restaurant.name}"
                    >


                    <!-- Favorite button -->
                    <button
                        class="favorite-btn"
                        type="button"
                        aria-label="Add ${restaurant.name} to favorites"
                    >
                        <i class="fa-regular fa-heart"></i>
                    </button>


                    <!-- Restaurant status -->
                    <span class="restaurant-status">

                        <i class="fa-solid fa-circle"></i>

                        Open

                    </span>

                </div>


                <!-- Restaurant information -->
                <div class="restaurant-info">


                    <!-- Restaurant name -->
                    <h3>
                        ${restaurant.name}
                    </h3>


                    <!-- Rating and delivery time -->
                    <div class="restaurant-meta">

                        <span>

                            <i class="fa-solid fa-star"></i>

                            4.8

                        </span>


                        <span>

                            <i class="fa-solid fa-clock"></i>

                            25-35 min

                        </span>

                    </div>


                    <!-- Restaurant description -->
                    <p class="restaurant-description">

                        ${restaurant.description}

                    </p>


                    <!-- Restaurant address -->
                    <p class="restaurant-address">

                        <i class="fa-solid fa-location-dot"></i>

                        ${restaurant.address}

                    </p>


                    <!-- Card bottom -->
                    <div class="restaurant-bottom">


                        <!-- Delivery information -->
                        <span class="delivery-info">

                            <i class="fa-solid fa-motorcycle"></i>

                            Free delivery

                        </span>


                        <!-- View menu button -->
                        <a
                            href="#"
                            class="menu-btn"
                        >

                            View Menu

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </div>

            `;


            // Card ko restaurant list mein add karna
            restaurantList.appendChild(card);

        });

    })

    // Agar API mein koi error aaye
    .catch(error => {

        // Error ko browser console mein show karna
        console.error("Error loading restaurants:", error);


        // User ko error message show karna
        restaurantList.innerHTML = `

            <p class="loading-message">

                Unable to load restaurants.
                Please try again later.

            </p>

        `;

    });


// =====================================================
// 4. MOBILE NAVIGATION MENU
// =====================================================


// Check karna ke hamburger aur navigation available hain
if (menuToggle && navLinks) {


    // Hamburger button par click event
    menuToggle.addEventListener("click", function () {


        // Mobile menu ko open/close karna
        navLinks.classList.toggle("mobile-open");


        // Hamburger icon select karna
        const menuIcon =
            menuToggle.querySelector("i");


        // Agar menu open hai
        if (
            navLinks.classList.contains("mobile-open")
        ) {


            // Bars icon ko X mein change karna
            menuIcon.classList.remove("fa-bars");

            menuIcon.classList.add("fa-xmark");


        } else {


            // Menu close hone par X ko bars mein change karna
            menuIcon.classList.remove("fa-xmark");

            menuIcon.classList.add("fa-bars");

        }

    });

}


// =====================================================
// 5. RESTAURANT SEARCH
// =====================================================


// Search input available hai to search functionality enable karo
if (restaurantSearch) {


    // User jab search box mein type kare
    restaurantSearch.addEventListener(
        "input",
        function () {


            // User ka search text lena
            const searchText =
                restaurantSearch.value
                    .toLowerCase()
                    .trim();


            // Saare restaurant cards select karna
            const restaurantCards =
                document.querySelectorAll(
                    ".restaurant-card"
                );


            // Har card ko check karna
            restaurantCards.forEach(card => {


                // Card ka complete text lena
                const cardText =
                    card.textContent.toLowerCase();


                // Check karna ke search text card mein hai ya nahi
                if (cardText.includes(searchText)) {


                    // Matching restaurant show karo
                    card.style.display = "";


                } else {


                    // Non-matching restaurant hide karo
                    card.style.display = "none";

                }

            });

        }
    );

}


// =====================================================
// 6. FAVORITE BUTTON
// =====================================================


// Jab user favorite buttons par click kare
document.addEventListener(
    "click",
    function (event) {


        // Check karna ke click favorite button par hua
        const favoriteButton =
            event.target.closest(".favorite-btn");


        // Agar favorite button par click nahi hua
        if (!favoriteButton) {

            return;

        }


        // Heart icon select karna
        const heartIcon =
            favoriteButton.querySelector("i");


        // Heart ko favorite/unfavorite toggle karna
        if (
            heartIcon.classList.contains("fa-regular")
        ) {


            // Empty heart → filled heart
            heartIcon.classList.remove("fa-regular");

            heartIcon.classList.add("fa-solid");


            // Favorite color
            favoriteButton.style.color = "#e85d04";


        } else {


            // Filled heart → empty heart
            heartIcon.classList.remove("fa-solid");

            heartIcon.classList.add("fa-regular");


            // Normal color
            favoriteButton.style.color = "#555";

        }

    }
);