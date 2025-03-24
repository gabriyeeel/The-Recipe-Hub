<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Recipe Hub</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
            margin: 0;
            padding: 0;
            background-color: #F0EBE3;
        }

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
        .about-title {
            text-align: center;
            padding: 40px 0;
            background-color: #d0a772;
            color: black;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .about-title h1 {
            margin: 0;
            color: black;
        }

        main {
            padding: 20px;
            margin: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        section {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fefefe;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .owner-container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .owner-container img {
            border-radius: 20%;
            height: 300px;
            width: 250px;
            margin-right: 20px;
        }

        .owner-description {
            text-align: left;
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
                <a href="#" class="logout" onclick="logoutUser()">Logout</a>
            <?php else: ?>
                <a href="login-signup.php" class="logout" font-size: 18px;">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Centered About Us Title -->
<div class="about-title">
    <h1>About Us</h1>
</div>

<main>
    <section id="about-owner">
        <div class="owner-container">
            <img src="owner.jpg" alt="Owner's Picture">
            <div class="owner-description">
                <h2>About the Owner</h2>
                <p>Hello! I'm [Owner's Name], the creator of this recipe website. Cooking has always been my passion, and I believe that sharing delicious recipes can bring people together. My goal is to provide you with easy-to-follow recipes that anyone can make at home. I hope you enjoy exploring the culinary world with me!</p>
            </div>
        </div>
    </section>

    <section id="contact">
        <h2>Contact</h2>
        <p>If you have any questions, suggestions, or just want to say hello, feel free to reach out!</p>
        <p>Email: <a href="mailto:owner@example.com">owner@example.com</a></p>
        <p>Phone: +1 (234) 567-8901</p>
    </section>
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
                // Palitan ang user info at gawin itong Login button na naka-bold
                document.getElementById("userSection").innerHTML =  
                    '<a href="login-signup.php" class="logout">Login</a>';
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>
