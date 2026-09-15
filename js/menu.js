// =====================================================
// CraveGo - Menu JavaScript
// Purpose:
// 1. Foods API se data lena
// 2. Food cards dynamically create karna
// 3. Category filters create karna
// 4. Search functionality
// 5. Favorite button control
// 6. Add to Cart functionality
// 7. Mobile navigation control
// =====================================================


// -----------------------------------------------------
// API URL
// -----------------------------------------------------

const foodApiUrl = "api/foods.php";


// -----------------------------------------------------
// HTML elements ko select karna
// -----------------------------------------------------

const foodList = document.getElementById("food-list");

const foodSearch = document.getElementById("food-search");

const categoryFilters =
    document.getElementById("category-filters");

const menuToggle =
    document.getElementById("menu-toggle");

const navLinks =
    document.querySelector(".nav-links");


// -----------------------------------------------------
// Foods ka data yahan store hoga
// -----------------------------------------------------

let allFoods = [];


// =====================================================
// FUNCTION: displayFoods()
// Purpose:
// Foods ko HTML cards mein convert karna
// =====================================================

function displayFoods(foods) {

    // Pehle existing cards remove karna
    foodList.innerHTML = "";


    // Agar search/filter ke baad koi food na mile
    if (foods.length === 0) {

        foodList.innerHTML = `
            <p class="loading-message">
                <i class="fa-solid fa-face-sad-tear"></i>
                No food items found.
            </p>
        `;

        return;
    }


    // Har food ke liye card create karna
    foods.forEach(food => {

        // Naya article element create karna
        const card = document.createElement("article");


        // Card ki class
        card.className = "food-menu-card";


        // Food card ka HTML
        card.innerHTML = `

            <!-- Food Image -->
            <div class="food-menu-image">

                <img
                    src="images/${food.image}"
                    alt="${food.name}"
                >


                <!-- Favorite Button -->
                <button
                    class="food-favorite"
                    type="button"
                    aria-label="Add ${food.name} to favorites"
                >

                    <i class="fa-regular fa-heart"></i>

                </button>


                <!-- Category Badge -->
                <span class="food-category-badge">
                    ${food.category_name}
                </span>

            </div>


            <!-- Food Information -->
            <div class="food-menu-info">

                <!-- Food Name -->
                <h3>
                    ${food.name}
                </h3>


                <!-- Restaurant -->
                <p class="food-restaurant">

                    <i class="fa-solid fa-store"></i>

                    ${food.restaurant_name}

                </p>


                <!-- Description -->
                <p class="food-description">
                    ${food.description}
                </p>


                <!-- Bottom Area -->
                <div class="food-menu-bottom">

                    <!-- Price -->
                    <strong class="food-menu-price">
                        Rs. ${food.price}
                    </strong>


                    <!-- Add to Cart Button -->
                    <button
                        class="add-cart-btn"
                        type="button"
                        data-id="${food.id}"
                    >

                        <i class="fa-solid fa-cart-plus"></i>

                        Add to Cart

                    </button>

                </div>

            </div>
        `;


        // Card ko page par add karna
        foodList.appendChild(card);

    });

}


// =====================================================
// FUNCTION: createCategoryFilters()
// Purpose:
// Database se unique categories nikalna
// aur filter buttons create karna.
// =====================================================

function createCategoryFilters() {

    // Categories ko store karne ke liye empty array
    const categories = [];


    // Saare foods check karna
    allFoods.forEach(food => {

        // Agar category pehle se array mein nahi hai
        if (!categories.includes(food.category_name)) {

            categories.push(food.category_name);

        }

    });


    // Har category ke liye button create karna
    categories.forEach(category => {

        const button = document.createElement("button");


        // Button ki class
        button.className = "category-filter";


        // Button type
        button.type = "button";


        // Category ko data attribute mein store karna
        button.dataset.category = category;


        // Button ka HTML
        button.innerHTML = `
            <i class="fa-solid fa-utensils"></i>
            ${category}
        `;


        // Category button click event
        button.addEventListener("click", function () {

            // Sab category buttons se active class remove
            document
                .querySelectorAll(".category-filter")
                .forEach(btn => {

                    btn.classList.remove("active");

                });


            // Current button ko active banana
            this.classList.add("active");


            // Selected category lena
            const selectedCategory =
                this.dataset.category;


            // Selected category ke foods filter karna
            const filteredFoods =
                allFoods.filter(food => {

                    return (
                        food.category_name ===
                        selectedCategory
                    );

                });


            // Filtered foods display karna
            displayFoods(filteredFoods);

        });


        // Button ko category container mein add karna
        categoryFilters.appendChild(button);

    });

}


// =====================================================
// CATEGORY "ALL" BUTTON
// =====================================================

const allCategoryButton =
    document.querySelector('[data-category="all"]');


if (allCategoryButton) {

    allCategoryButton.addEventListener("click", function () {

        // Sab buttons se active class remove
        document
            .querySelectorAll(".category-filter")
            .forEach(btn => {

                btn.classList.remove("active");

            });


        // All button active
        this.classList.add("active");


        // Saare foods display
        displayFoods(allFoods);

    });

}


// =====================================================
// SEARCH FUNCTIONALITY
// =====================================================

if (foodSearch) {

    foodSearch.addEventListener("input", function () {

        // User ka search text
        const searchText =
            foodSearch.value.toLowerCase().trim();


        // Search ke according foods filter karna
        const filteredFoods =
            allFoods.filter(food => {

                return (

                    food.name
                        .toLowerCase()
                        .includes(searchText) ||

                    food.description
                        .toLowerCase()
                        .includes(searchText) ||

                    food.category_name
                        .toLowerCase()
                        .includes(searchText) ||

                    food.restaurant_name
                        .toLowerCase()
                        .includes(searchText)

                );

            });


        // Search results display karna
        displayFoods(filteredFoods);

    });

}


// =====================================================
// FAVORITE BUTTON
// =====================================================

document.addEventListener("click", function (event) {

    // Check karna ke favorite button click hua hai ya nahi
    const favoriteButton =
        event.target.closest(".food-favorite");


    // Agar favorite button click nahi hua
    // to function stop
    if (!favoriteButton) return;


    // Heart icon select karna
    const heartIcon =
        favoriteButton.querySelector("i");


    // Empty heart ko filled heart banana
    if (heartIcon.classList.contains("fa-regular")) {

        heartIcon.classList.remove("fa-regular");

        heartIcon.classList.add("fa-solid");

        favoriteButton.classList.add("favorite-active");

    }

    // Filled heart ko empty heart banana
    else {

        heartIcon.classList.remove("fa-solid");

        heartIcon.classList.add("fa-regular");

        favoriteButton.classList.remove("favorite-active");

    }

});


// =====================================================
// ADD TO CART BUTTON
// Purpose:
// User jab "Add to Cart" click karega,
// selected food cart mein add hoga.
// =====================================================

document.addEventListener("click", function (event) {

    // Check karna ke Add to Cart button click hua hai
    const cartButton =
        event.target.closest(".add-cart-btn");


    // Agar Add to Cart button click nahi hua
    // to function stop
    if (!cartButton) return;


    // Button ke data-id se food ID lena
    const foodId =
        cartButton.dataset.id;


    // allFoods array mein selected food find karna
    const selectedFood =
        allFoods.find(food => food.id == foodId);


    // Agar food successfully mil gaya
    if (selectedFood) {

        // cart.js ka addToCart() function call karna
        addToCart(selectedFood);

    }

});


// =====================================================
// FOODS API SE DATA FETCH KARNA
// =====================================================

fetch(foodApiUrl)

    .then(response => {

        // API response ko JSON mein convert karna
        return response.json();

    })

    .then(foods => {

        // Foods ko global variable mein save karna
        allFoods = foods;


        // Agar koi food available nahi hai
        if (allFoods.length === 0) {

            foodList.innerHTML = `
                <p class="loading-message">
                    No food items found.
                </p>
            `;

            return;
        }


        // Food categories create karna
        createCategoryFilters();


        // Initial food cards display karna
        displayFoods(allFoods);

    })

    .catch(error => {

        // API error console mein show karna
        console.error(
            "Error loading foods:",
            error
        );


        // User ko error message show karna
        foodList.innerHTML = `
            <p class="loading-message">
                Unable to load food items.
                Please try again later.
            </p>
        `;

    });


// =====================================================
// MOBILE NAVIGATION
// =====================================================

if (menuToggle && navLinks) {

    menuToggle.addEventListener("click", function () {

        // Mobile menu open/close
        navLinks.classList.toggle("mobile-open");


        // Menu icon select karna
        const menuIcon =
            menuToggle.querySelector("i");


        // Agar menu open hai
        if (
            navLinks.classList.contains(
                "mobile-open"
            )
        ) {

            menuIcon.classList.remove("fa-bars");

            menuIcon.classList.add("fa-xmark");

        }

        // Agar menu close hai
        else {

            menuIcon.classList.remove("fa-xmark");

            menuIcon.classList.add("fa-bars");

        }

    });
}
