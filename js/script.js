// =====================================================
// HOME PAGE - LOAD POPULAR RESTAURANTS
// =====================================================

function loadHomeRestaurants() {

    const container =
        document.getElementById("home-restaurants");

    if (!container) {
        return;
    }

    fetch("api/restaurants.php")

        .then(response => response.json())

        .then(result => {

            console.log("Restaurants API:", result);

            const restaurants =
                result.data || result.restaurants || result;

            if (!Array.isArray(restaurants) || restaurants.length === 0) {

                container.innerHTML = `
                    <div class="home-loading">
                        No restaurants available.
                    </div>
                `;

                return;
            }

            container.innerHTML = "";

            restaurants
                .slice(0, 3)
                .forEach(restaurant => {

                    const card =
                        document.createElement("div");

                    card.className =
                        "home-restaurant-card";

                    card.innerHTML = `

                        <div class="home-restaurant-image">

                            <img
                                src="images/${restaurant.image}"
                                alt="${restaurant.name}"
                                onerror="this.style.display='none';"
                            >

                        </div>

                        <div class="home-restaurant-info">

                            <span class="restaurant-category">
                                ${restaurant.category || "Restaurant"}
                            </span>

                            <h3>
                                ${restaurant.name}
                            </h3>

                            <p>
                                ${restaurant.description || "Delicious food and great taste."}
                            </p>

                            <div class="restaurant-meta">

                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    ${restaurant.rating || "4.8"}
                                </span>

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>
                                    ${restaurant.location || "Pakistan"}
                                </span>

                            </div>

                        </div>
                    `;

                    container.appendChild(card);

                });

        })

        .catch(error => {

            console.error(
                "Restaurant API Error:",
                error
            );

            container.innerHTML = `
                <div class="home-loading">
                    Unable to load restaurants.
                </div>
            `;

        });
}


// =====================================================
// HOME PAGE - LOAD POPULAR DISHES
// =====================================================

function loadHomeFoods() {

    const container =
        document.getElementById("home-foods");

    if (!container) {
        return;
    }

    fetch("api/foods.php")

        .then(response => response.json())

        .then(result => {

            console.log("Foods API:", result);

            const foods =
                result.data || result.foods || result;

            if (!Array.isArray(foods) || foods.length === 0) {

                container.innerHTML = `
                    <div class="home-loading">
                        No dishes available.
                    </div>
                `;

                return;
            }

            container.innerHTML = "";

            foods
                .slice(0, 4)
                .forEach(food => {

                    const card =
                        document.createElement("div");

                    card.className =
                        "home-food-card";

                    card.innerHTML = `

                        <div class="home-food-image">

                            <img
                                src="images/${food.image}"
                                alt="${food.name}"
                                onerror="this.style.display='none';"
                            >

                        </div>

                        <div class="home-food-info">

                            <span class="food-category">
                                ${food.category_name || food.category || "Food"}
                            </span>

                            <h3>
                                ${food.name}
                            </h3>

                            <p>
                                ${food.restaurant_name || "CraveGo Restaurant"}
                            </p>

                            <div class="home-food-bottom">

                                <strong>
                                    Rs. ${Number(food.price).toFixed(0)}
                                </strong>

                                <button
                                    type="button"
                                    class="home-add-cart"
                                    onclick='addHomeFoodToCart(${JSON.stringify(food)})'
                                >
                                    <i class="fa-solid fa-plus"></i>
                                </button>

                            </div>

                        </div>
                    `;

                    container.appendChild(card);

                });

        })

        .catch(error => {

            console.error(
                "Food API Error:",
                error
            );

            container.innerHTML = `
                <div class="home-loading">
                    Unable to load dishes.
                </div>
            `;

        });
}


// =====================================================
// ADD HOME FOOD TO CART
// =====================================================

function addHomeFoodToCart(food) {

    let cart =
        JSON.parse(
            localStorage.getItem("cravego_cart")
        ) || [];

    const existing =
        cart.find(
            item => Number(item.id) === Number(food.id)
        );

    if (existing) {

        existing.quantity += 1;

    } else {

        cart.push({

            id: food.id,

            name: food.name,

            price: Number(food.price),

            image: food.image,

            quantity: 1

        });

    }

    localStorage.setItem(
        "cravego_cart",
        JSON.stringify(cart)
    );

    alert(
        `${food.name} added to cart!`
    );

    updateHomeCartCount();
}


// =====================================================
// UPDATE CART COUNT
// =====================================================

function updateHomeCartCount() {

    const cart =
        JSON.parse(
            localStorage.getItem("cravego_cart")
        ) || [];

    const count =
        cart.reduce(
            (total, item) =>
                total + Number(item.quantity || 0),
            0
        );

    document
        .querySelectorAll(".cart-count")
        .forEach(element => {

            element.textContent = count;

        });
}


// =====================================================
// PAGE LOAD
// =====================================================

document.addEventListener(
    "DOMContentLoaded",
    function() {

        loadHomeRestaurants();

        loadHomeFoods();

        updateHomeCartCount();

    }
);