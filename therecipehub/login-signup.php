<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In / Sign Up Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #F0EBE3;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
            color: #8A6240;
        }

        h2 {
            font-weight: bold;
            margin: 0;
            color: white;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
            color: #8A6240;
        }

        span {
            font-size: 12px;
            color: #8A6240;
        }

        a {
            color: white; /* Set the color to white */
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #d0a772;
            background-color: #d0a772;
            color: #8A6240;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #8A6240;
        }

        form {
            background-color: #8A6240;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            border-radius: 10px;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            outline: none;
            position: relative; /* Added for positioning the eye icon */
        }

        .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .row > div {
            width: 48%; /* Adjust width to fit two inputs side by side */
        }

        .password-container {
            position: relative; /* Position relative for the eye icon */
            width: 100%;
        }

        .container {
            background-color: #EEEEFF;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                        0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 900px;
            max-width: 100%;
            min-height: 600px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #EEEEFF;
            background: -webkit-linear-gradient(to right, #EEEEFF, #EEEEFF);
            background: linear-gradient(to right, #EEEEFF, #EEEEFF);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #3c97bf;
            text-decoration: none;
        }

        .logo {
            margin-bottom: -10px;
        }

        .logo img {
            width: 250px;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="signup.php" method="POST">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <h2>Create Account</h2><br>
            <div class="row">
                <div>
                    <input type="text" name="fname" placeholder="First Name" required />
                </div>
                <div>
                    <input type="text" name="lname" placeholder="Last Name" required />
                </div>
            </div>
            <div class="row">
                <div>
                    <input type="text" name="username" placeholder="Username" required />
                </div>
                <div>
                    <input type="email" name="email" placeholder="Email" required />
                </div>
            </div>
            <input type="text" name="contact" placeholder="Contact Number" required />
            <div class="password-container">
                <input type="password" name="password" id="signUpPassword" placeholder="Password" required />
                <i class="fas fa-eye-slash" id="toggleSignUpPassword" style="position: absolute; right: 15px; top: 12px; cursor: pointer;"></i>
            </div><br>
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="login.php" method="POST">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div><br>
            <h2>Log In</h2><br>
            <input type="email" name="email" placeholder="Email" required />
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Password" required />
                <i class="fas fa-eye-slash" id="togglePassword" style="position: absolute; right: 15px; top: 12px; cursor: pointer;"></i>
            </div><br>

            <!-- Display error message in red -->
            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red; font-size: 14px;"><?php echo $_SESSION['error']; ?></p>
                <?php unset($_SESSION['error']); // Remove error after displaying ?>
            <?php endif; ?>

            <a href="#" style="color: white;">Forgot your password?</a><br>
            <button type="submit">Log In</button>
        </form>
        
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome to our website!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signIn">Log In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Welcome back to our website!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <br><br>
                <span> Don't have an account? </span><br>
                <button class="ghost" id="signUp">Sign Up Here</button>
            </div>
        </div>
    </div>
</div>

<script>
        document.addEventListener("DOMContentLoaded", function() {
        document.body.style.opacity = "1"; // Fade in on load

        document.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", function(event) {
                if (this.classList.contains("logout")) {
                    // Handle logout separately
                    event.preventDefault();
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
                    }, 300); // Adjust timing if needed
                } else {
                    // Normal page transitions
                    event.preventDefault();
                    const href = this.href;
                    document.body.style.opacity = "0"; // Fade-out effect
                    setTimeout(() => {
                        window.location.href = href;
                    }, 300); // Adjust timing if needed
                }
            });
        });
    });

    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    const passwordInput = document.getElementById('password');
    const signUpPasswordInput = document.getElementById('signUpPassword');
    const togglePassword = document.getElementById('togglePassword');
    const toggleSignUpPassword = document.getElementById('toggleSignUpPassword');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    // Toggle password visibility
    togglePassword.addEventListener('click', () => {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        togglePassword.classList.toggle('fa-eye-slash', type === 'text');
    });

    toggleSignUpPassword.addEventListener('click', () => {
        const type = signUpPasswordInput.type === 'password' ? 'text' : 'password';
        signUpPasswordInput.type = type;
        toggleSignUpPassword.classList.toggle('fa-eye-slash', type === 'text');
    });
</script>

</body>
</html>
