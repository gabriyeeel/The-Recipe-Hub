<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Browser</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F0EBE3;
        }

        /* Default opacity for smooth transition */
        body {
            opacity: 0;
            transition: opacity 0.3s ease-in-out; /* Mas mabilis na fade-in */
        }

        body.fade-out {
            opacity: 0;
            transition: opacity 0.2s ease-in-out; /* Mas mabilis na fade-out */
        }

        /* ===== Header & Navigation ===== */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #8A6240;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            height: 100px;
            width: 230px;
        }

        .nav-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #d0a772;
            color: white;
            border-radius: 10px;
            transform: scale(1.05);
        }

        /* ===== User Info & Logout Button ===== */
        .user-info {
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            background-color: #a87c5f;
            border-radius: 10px;
        }

        .logout {
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .logout:hover {
            background-color: #d0a772;
        }

        /* ===== Category Buttons ===== */
        .category-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 20px auto;
        }

        .category {
            background-color: #EEEEFF;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .category:hover {
            background-color: #d0a772;
            color: white;
            transform: scale(1.1);
        }

        .active-category {
            background-color: #d0a772 !important;
            color: white;
        }

        /* ===== Recipe Grid ===== */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .recipe-card {
            background: #EEEEFF;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            position: relative;
        }

        .recipe-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .recipe-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .recipe-info {
            padding: 15px;
        }

        .recipe-info h3 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .recipe-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0;
            color: #666;
            font-size: 14px;
        }

        .view-recipe {
            display: block;
            text-align: center;
            background: #d0a772;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .view-recipe:hover {
            background: #b8865b;
        }

        /* ===== Recipe Title ===== */
        .recipe-title {
            text-align: center;
            padding: 40px 0;
            background-color: #d0a772;
            color: black;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .recipe-title h1 {
            margin: 0;
        }

        /* ===== Footer ===== */
        footer {
            background-color: #8A6240;
            padding: 20px;
            text-align: center;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            color: white;
        }

        footer a {
            text-decoration: none;
            color: white;
            margin: 0 10px;
        }

        /* Modal Overlay (Hidden by Default) */
        .modal-content {
            background: #d0a772;
            padding: 30px; /* Increased padding */
            border-radius: 15px; /* Softer corners */
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px; /* Increased width */
        }

        .modal-overlay {
            display: none; /* Ensure it's hidden initially */
            position: fixed; /* Para laging nasa ibabaw */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Siguraduhin na nasa taas ng lahat */
        }

        .modal-overlay.show {
            display: flex;
        }

        /* Modal Buttons (Bigger Size) */
        #confirmLogout, #cancelLogout {
            padding: 12px 20px; /* Increased padding */
            font-size: 18px; /* Bigger text */
            border: none;
            cursor: pointer;
            margin: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        #confirmLogout {
            background-color: #ffffff;
            color: #8A6240;
            border: 2px solid #8A6240;
        }

        #confirmLogout:hover {
            background-color: #f5ebe0;
            transform: scale(1.05);
        }

        #cancelLogout {
            background-color: #ffffff;
            color: #8A6240;
            border: 2px solid #8A6240;
        }

        #cancelLogout:hover {
            background-color: #f5ebe0;
            transform: scale(1.05);
        }


    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="home.php">
            <img src="logo.png" alt="Logo">
        </a>
    </div>
    
    <div class="nav-container">
        <nav>
            <a href="home.php">Home</a>
            <a href="browse.php">Browse Recipes</a>
            <a href="about.php">About</a>
        </nav>

        <div id="userSection">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="user-info">Hello, <?php echo $_SESSION['username']; ?>!</span>
                <a href="#" class="logout" id="logoutBtn">Logout</a>
            <?php else: ?>
                <a href="login-signup.php" class="logout">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-content">
            <p>Are you sure you want to logout?</p>
            <button id="confirmLogout">Yes</button>
            <button id="cancelLogout">No</button>
        </div>
    </div> 
</header>

<div class="recipe-title">
    <h1>Browse Recipes</h1>
</div>

<div class="category-container">
    <div class="category active-category" onclick="showCategory('all', this)">All</div>
    <div class="category" onclick="showCategory('breakfast', this)">Breakfast</div>
    <div class="category" onclick="showCategory('lunch', this)">Lunch</div>
    <div class="category" onclick="showCategory('dinner', this)">Dinner</div>
</div>

<div id="recipes-container" class="grid-container"></div>

<footer>
    <p>&copy; 2025 The Recipe Hub. All rights reserved.</p>
    <p>
        <a href="#privacy-policy">Privacy Policy</a> | 
        <a href="#terms-of-service">Terms of Service</a> | 
        <a href="#contact">Contact Us</a>
    </p>
    <p>
        Follow us on:
        <a href="#facebook">Facebook</a> |
        <a href="#twitter">Twitter</a> |
        <a href="#instagram">Instagram</a>
    </p>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.body.style.opacity = "1"; // Fade in on load

    document.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", function(event) {
            if (!this.href.includes("logout.php")) { // Avoid logout interfering
                event.preventDefault();
                const href = this.href;
                document.body.classList.add("fade-out"); // Apply fade-out class

                setTimeout(() => {
                    window.location.href = href;
                }, 50); // Delay for transition
            }
        });
    });
});

function logoutUser() {
    fetch('logout.php')
    .then(response => response.json()) // Convert response to JSON
    .then(data => {
        if (data.status === "success") {
            document.getElementById("userSection").innerHTML = '<a href="login-signup.php" class="logout">Login</a>';
        }
    })
    .catch(error => console.error('Error:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    document.body.style.opacity = "1"; // Fade in on load

    document.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", function(event) {
            if (this.classList.contains("logout")) {
                // Show Logout Modal Instead
                event.preventDefault();
                document.getElementById("logoutModal").classList.add("show");
            } else {
                // Normal Page Transitions
                event.preventDefault();
                const href = this.href;
                document.body.style.opacity = "0"; // Fade-out effect
                setTimeout(() => {
                    window.location.href = href;
                }, 300);
            }
        });
    });

    // Logout Confirmation Buttons
    document.getElementById("confirmLogout").addEventListener("click", function() {
        document.body.style.opacity = "0"; // Fade-out effect
        setTimeout(() => {
            fetch('logout.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        window.location.href = "login-signup.php";
                    }
                })
                .catch(error => console.error('Error:', error));
        }, 300);
    });

    document.getElementById("cancelLogout").addEventListener("click", function() {
        document.getElementById("logoutModal").classList.remove("show");
    });
});

        const recipes = {
            all: [
                { name: "Pancakes", image: "pancakes.jpg", time: "15 mins", difficulty: "Easy" },
                { name: "Omelette", image: "omelette.jpg", time: "10 mins", difficulty: "Easy" },
                { name: "Grilled Chicken Salad", image: "salad.jpg", time: "20 mins", difficulty: "Easy" },
                { name: "Beef Steak", image: "beefsteak.jpg", time: "40 mins", difficulty: "Hard" }
            ],
            breakfast: [
                { name: "Pancakes", image: "pancakes.jpg", time: "15 mins", difficulty: "Easy" },
                { name: "Omelette", image: "omelette.jpg", time: "10 mins", difficulty: "Easy" }
            ],
            lunch: [
                { name: "Grilled Chicken Salad", image: "salad.jpg", time: "20 mins", difficulty: "Easy" }
            ],
            dinner: [
                { name: "Beef Steak", image: "beefsteak.jpg", time: "40 mins", difficulty: "Hard" }
            ]
        };

        function showCategory(category, element) {
            document.querySelectorAll('.category').forEach(btn => btn.classList.remove('active-category'));
            element.classList.add('active-category');

            const container = document.getElementById("recipes-container");
            container.innerHTML = "";
            container.style.opacity = "0";
            container.style.transform = "translateY(20px)";

            setTimeout(() => {
                recipes[category].forEach(recipe => {
                    container.innerHTML += `
                        <div class="recipe-card">
                            <img src="${recipe.image}" alt="${recipe.name}">
                            <div class="recipe-info">
                                <h3>${recipe.name}</h3>
                                <div class="recipe-meta">⏱️ ${recipe.time} | ⭐ ${recipe.difficulty}</div>
                                <a href="recipe.php?recipe=${encodeURIComponent(recipe.name)}" class="view-recipe">View Recipe</a>
                            </div>
                        </div>
                    `;
                });

                container.style.opacity = "1";
                container.style.transform = "translateY(0)";
            }, 200);
        }

        // Show "All" category on page load
        window.onload = function() {
            showCategory('all', document.querySelector('.category.active-category'));
        };

        function logoutUser() {
            fetch('logout.php')
            .then(response => response.json()) // Convert response to JSON
            .then(data => {
                if (data.status === "success") {
                    // Remove user info and change Logout button to Login button
                    document.getElementById("userSection").innerHTML =  '<a href="login-signup.php" class="logout">Login</a>';
                }
            })
            .catch(error => console.error('Error:', error));
        }

    </script>

</body>
</html>
