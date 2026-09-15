// =====================================================
// CraveGo - Cart JavaScript
// Purpose:
// 1. Cart items ko LocalStorage mein save karna
// 2. Cart mein food add karna
// 3. Cart items ko screen par display karna
// 4. Cart count update karna
// 5. Quantity increase/decrease karna
// 6. Cart se item remove karna
// 7. Subtotal, delivery fee aur total calculate karna
// =====================================================


// -----------------------------------------------------
// LocalStorage se existing cart lena
// Agar cart nahi hai to empty array use hoga.
// -----------------------------------------------------

let cart = JSON.parse(
    localStorage.getItem("cravego_cart")
) || [];


// =====================================================
// FUNCTION: saveCart()
// Purpose:
// Current cart ko LocalStorage mein save karna.
// =====================================================

function saveCart() {

    localStorage.setItem(
        "cravego_cart",
        JSON.stringify(cart)
    );

}


// =====================================================
// FUNCTION: updateCartCount()
// Purpose:
// Navbar mein cart ke total items show karna.
// =====================================================

function updateCartCount() {

    const cartCounts =
        document.querySelectorAll(".cart-count");


    // Cart ki total quantity calculate karna
    const totalItems = cart.reduce(
        (total, item) => total + item.quantity,
        0
    );


    // Har cart-count element ko update karna
    cartCounts.forEach(countElement => {

        countElement.textContent = totalItems;

    });

}


// =====================================================
// FUNCTION: addToCart()
// Purpose:
// Food item ko cart mein add karna.
// =====================================================

function addToCart(food) {

    // Check karna ke food already cart mein hai ya nahi
    const existingItem = cart.find(
        item => item.id == food.id
    );


    if (existingItem) {

        // Agar item already cart mein hai
        // to quantity increase karna
        existingItem.quantity += 1;

    } else {

        // Agar new item hai
        // to cart mein add karna
        cart.push({

            id: food.id,

            name: food.name,

            price: Number(food.price),

            image: food.image,

            restaurant: food.restaurant_name,

            quantity: 1

        });

    }


    // Cart save karna
    saveCart();


    // Navbar cart count update karna
    updateCartCount();


    // Agar cart page open hai
    // to cart ko dobara display karna
    renderCart();


    // User ko confirmation
    alert(`${food.name} added to cart!`);

}


// =====================================================
// FUNCTION: increaseQuantity()
// Purpose:
// Kisi food ki quantity +1 karna.
// =====================================================

function increaseQuantity(foodId) {

    const item = cart.find(
        item => item.id == foodId
    );


    if (item) {

        item.quantity += 1;

        saveCart();

        updateCartCount();

        renderCart();

    }

}


// =====================================================
// FUNCTION: decreaseQuantity()
// Purpose:
// Kisi food ki quantity -1 karna.
// =====================================================

function decreaseQuantity(foodId) {

    const item = cart.find(
        item => item.id == foodId
    );


    // Agar item nahi mila
    // to function stop
    if (!item) return;


    // Quantity decrease karna
    item.quantity -= 1;


    // Agar quantity zero ho jaye
    // to item ko cart se remove karna
    if (item.quantity <= 0) {

        cart = cart.filter(
            item => item.id != foodId
        );

    }


    // Cart save karna
    saveCart();


    // Navbar count update
    updateCartCount();


    // Cart display update
    renderCart();

}


// =====================================================
// FUNCTION: removeFromCart()
// Purpose:
// Cart se complete food item remove karna.
// =====================================================

function removeFromCart(foodId) {

    cart = cart.filter(
        item => item.id != foodId
    );


    // Updated cart save karna
    saveCart();


    // Navbar count update
    updateCartCount();


    // Cart page update
    renderCart();

}


// =====================================================
// FUNCTION: calculateSubtotal()
// Purpose:
// Cart ke tamam items ka subtotal calculate karna.
// =====================================================

function calculateSubtotal() {

    return cart.reduce(

        (total, item) => {

            return total +
                (item.price * item.quantity);

        },

        0

    );

}


// =====================================================
// FUNCTION: updateCartSummary()
// Purpose:
// Subtotal, delivery fee aur final total update karna.
// =====================================================

function updateCartSummary() {

    // Subtotal calculate karna
    const subtotal =
        calculateSubtotal();


    // Abhi hum Rs. 150 fixed delivery fee use kar rahe hain
    // Agar cart empty hai to delivery fee 0 hogi.
    const deliveryFee =
        cart.length > 0 ? 150 : 0;


    // Final total
    const total =
        subtotal + deliveryFee;


    // HTML elements select karna
    const subtotalElement =
        document.getElementById("cart-subtotal");

    const deliveryElement =
        document.getElementById("delivery-fee");

    const totalElement =
        document.getElementById("cart-total");


    // Subtotal update
    if (subtotalElement) {

        subtotalElement.textContent =
            `Rs. ${subtotal.toFixed(2)}`;

    }


    // Delivery fee update
    if (deliveryElement) {

        deliveryElement.textContent =
            `Rs. ${deliveryFee.toFixed(2)}`;

    }


    // Final total update
    if (totalElement) {

        totalElement.textContent =
            `Rs. ${total.toFixed(2)}`;

    }


    // -------------------------------------------------
    // Cart mein total items count
    // -------------------------------------------------

    const itemCountElement =
        document.getElementById("cart-items-count");


    if (itemCountElement) {

        const totalItems = cart.reduce(
            (total, item) => total + item.quantity,
            0
        );


        itemCountElement.textContent =
            `${totalItems} ${totalItems === 1 ? "item" : "items"}`;

    }

}


// =====================================================
// FUNCTION: renderCart()
// Purpose:
// LocalStorage ke cart items ko cart.html par display karna.
// =====================================================

function renderCart() {

    // Cart items ka container select karna
    const cartItemsContainer =
        document.getElementById("cart-items");


    // Agar cart.html open nahi hai
    // to function stop kar dena
    if (!cartItemsContainer) return;


    // -------------------------------------------------
    // Agar cart empty hai
    // -------------------------------------------------

    if (cart.length === 0) {

        cartItemsContainer.innerHTML = `

            <div class="empty-cart">

                <div class="empty-cart-icon">

                    <i class="fa-solid fa-cart-shopping"></i>

                </div>


                <h3>
                    Your cart is empty
                </h3>


                <p>
                    Looks like you haven't added
                    anything to your cart yet.
                </p>


                <a
                    href="menu.html"
                    class="primary-btn"
                >

                    <i class="fa-solid fa-utensils"></i>

                    Explore Menu

                </a>

            </div>

        `;


        // Summary ko zero karna
        updateCartSummary();

        return;

    }


    // -------------------------------------------------
    // Existing cart items clear karna
    // -------------------------------------------------

    cartItemsContainer.innerHTML = "";


    // -------------------------------------------------
    // Har cart item ka card create karna
    // -------------------------------------------------

    cart.forEach(item => {

        const cartItem =
            document.createElement("div");


        cartItem.className =
            "cart-item";


        // Cart item ka HTML
        cartItem.innerHTML = `

            <!-- =====================================
                 FOOD IMAGE
                 ===================================== -->

            <div class="cart-item-image">

                <img
                    src="images/${item.image}"
                    alt="${item.name}"
                >

            </div>


            <!-- =====================================
                 FOOD INFORMATION
                 ===================================== -->

            <div class="cart-item-info">

                <h3>
                    ${item.name}
                </h3>


                <p class="cart-item-restaurant">

                    <i class="fa-solid fa-store"></i>

                    ${item.restaurant}

                </p>


                <strong class="cart-item-price">

                    Rs. ${item.price.toFixed(2)}

                </strong>

            </div>


            <!-- =====================================
                 QUANTITY CONTROL
                 ===================================== -->

            <div class="quantity-control">

                <button
                    type="button"
                    onclick="decreaseQuantity(${item.id})"
                    aria-label="Decrease quantity"
                >

                    <i class="fa-solid fa-minus"></i>

                </button>


                <span>
                    ${item.quantity}
                </span>


                <button
                    type="button"
                    onclick="increaseQuantity(${item.id})"
                    aria-label="Increase quantity"
                >

                    <i class="fa-solid fa-plus"></i>

                </button>

            </div>


            <!-- =====================================
                 ITEM TOTAL
                 ===================================== -->

            <strong class="cart-item-total">

                Rs.
                ${(item.price * item.quantity).toFixed(2)}

            </strong>


            <!-- =====================================
                 REMOVE BUTTON
                 ===================================== -->

            <button
                type="button"
                class="remove-cart-item"
                onclick="removeFromCart(${item.id})"
                aria-label="Remove ${item.name}"
            >

                <i class="fa-solid fa-trash"></i>

            </button>

        `;


        // Cart item ko container mein add karna
        cartItemsContainer.appendChild(cartItem);

    });


    // Summary update karna
    updateCartSummary();

}


// =====================================================
// PAGE LOAD
// =====================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        // Navbar cart count update
        updateCartCount();


        // Cart items display
        renderCart();

    }
);