<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        .recipe-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
        }

        .recipe-details {
            flex: 1;
            padding-right: 20px;
        }

        .recipe-image {
            flex: 1;
        }

        .recipe-image img {
            width: 100%;
            border-radius: 8px;
        }

        h1, h2 {
            color: #d0a772;
        }

        p, ul, ol {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            text-align: left;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #d0a772;
            color: black;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .back-btn:hover {
            background-color: #d0a772; /* Highlight color */
            color: white; /* Text color on hover */
            border-radius: 10px; /* Optional: rounded corners */
            transform: scale(1.05);
            transition: transform 0.3s;
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
    </header>

    <div class="recipe-container">
        <div class="recipe-details">
            <h1 id="recipe-title"></h1>
            <p id="recipe-description"></p>
            <p><strong>Time:</strong> <span id="recipe-time"></span></p>
            <p><strong>Difficulty:</strong> <span id="recipe-difficulty"></span></p>
            
            <h2>Ingredients</h2>
            <ul id="recipe-ingredients"></ul>
            
            <h2>Procedure</h2>
            <ol id="recipe-procedure"></ol>
            
            <button class="back-btn" onclick="goBack()">Back to Browse Recipes</button>
        </div>
        <div class="recipe-image">
            <img id="recipe-image" src="" alt="">
        </div>
    </div>

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
    
        const recipes = {
            "Pancakes": {
                image: "pancakes.jpg",
                description: "Fluffy pancakes made with flour, milk, eggs, and a touch of vanilla.",
                time: "15 mins",
                difficulty: "Easy",
                ingredients: ["1 cup flour", "1 cup milk", "1 egg", "1 tbsp sugar", "1 tsp baking powder", "1 tsp vanilla extract"],
                procedure: ["Mix dry ingredients in a bowl.", "Add milk, egg, and vanilla, then mix well.", "Heat a pan and pour batter.", "Cook until bubbles form, then flip.", "Serve with syrup."]
            },
            "Omelette": {
                image: "omelette.jpg",
                description: "A delicious omelette made with eggs, cheese, and fresh vegetables.",
                time: "10 mins",
                difficulty: "Easy",
                ingredients: ["2 eggs", "1/4 cup cheese", "1/4 cup chopped vegetables", "Salt and pepper to taste"],
                procedure: ["Beat eggs in a bowl.", "Heat a pan and add beaten eggs.", "Add cheese and vegetables.", "Fold the omelette and serve."]
            },
            "Grilled Chicken Salad": {
                image: "salad.jpg",
                description: "A refreshing salad featuring tender grilled chicken, mixed greens, cherry tomatoes, cucumbers, and a light vinaigrette, topped with crumbled feta cheese and crunchy walnuts.",
                time: "15 mins",
                difficulty: "Easy",
                ingredients: ["1 cup flour", "1 cup milk", "1 egg", "1 tbsp sugar", "1 tsp baking powder", "1 tsp vanilla extract"],
                procedure: ["Mix dry ingredients in a bowl.", "Add milk, egg, and vanilla, then mix well.", "Heat a pan and pour batter.", "Cook until bubbles form, then flip.", "Serve with syrup."]
            },
        };

        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        const recipeName = getQueryParam("recipe");

        if (recipeName && recipes[recipeName]) {
            const recipe = recipes[recipeName];
            document.getElementById("recipe-image").src = recipe.image;
            document.getElementById("recipe-title").textContent = recipeName;
            document.getElementById("recipe-description").textContent = recipe.description;
            document.getElementById("recipe-time").textContent = recipe.time;
            document.getElementById("recipe-difficulty").textContent = recipe.difficulty;
            
            const ingredientsList = document.getElementById("recipe-ingredients");
            recipe.ingredients.forEach(ingredient => {
                const li = document.createElement("li");
                li.textContent = ingredient;
                ingredientsList.appendChild(li);
            });
            
            const procedureList = document.getElementById("recipe-procedure");
            recipe.procedure.forEach(step => {
                const li = document.createElement("li");
                li.textContent = step;
                procedureList.appendChild(li);
            });
        } else {
            document.querySelector(".recipe-container").innerHTML = "<h1>Recipe not found!</h1>";
        }

        function goBack() {
            window.location.href = "browse.php";
        }
    </script>
</body>
</html>
