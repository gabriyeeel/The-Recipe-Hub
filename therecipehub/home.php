<?php
session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Website</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
            margin: 0;
            padding: 0;
            background-color: #F0EBE3;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
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
            cursor: pointer;
        }

        .logout:hover {
            background-color: #d0a772;
        }

        /* ===== Main Content ===== */
        main {
            padding: 20px;
            margin: 0 20px;
            text-align: center;
        }

        h1 {
            margin: 20px 0;
            font-size: 28px;
        }

        p {
            font-size: 18px;
            color: #333;
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
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dim background */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        /* Modal Box */
        .modal-content {
            background: #d0a772;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Show Modal */
        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Fade-In & Fade-Out Effect for Whole Page */
        body {
            opacity: 0;
            transition: opacity 0.3s ease;
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

        <div id="logoutModal" class="modal-overlay">
        <div class="modal-content">
            <p>Are you sure you want to logout?</p>
            <button id="confirmLogout">Yes</button>
            <button id="cancelLogout">No</button>
        </div>
</div>
</header>

<main>
    <h1>Welcome to The Recipe Hub!</h1>
    <p>Discover and share delicious recipes from around the world.</p>
</main>

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
// Page Fade In Effect
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
</script>

</body>
</html>

