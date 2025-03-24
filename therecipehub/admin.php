<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_lvl']) || $_SESSION['user_lvl'] != 1) {
    header("Location: home.php"); // Redirect non-admin users to home
    exit();
}

// Get admin username from session
$adminUsername = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Recipe Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
            margin: 0;
            padding: 0;
            background-color: #fff7e6;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #8A6240;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
        }
        .logo img {
            height: 100px;
            width: 230px;
        }
        .admin-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
        }
        .admin-info span {
            font-weight: bold;
        }
        .logout-btn {
            background-color: #8A6240;
            border: none;
            color: white;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
        }
        .logout-btn:hover {
            background-color: #d0a772;
            transform: scale(1.05);
        }
        .sidebar {
            width: 250px;
            background: #5a3825;
            color: white;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            left: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #d0a772;
            border-radius: 10px;
        }
        main {
            margin-left: 270px;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="#"><img src="logo.png" alt="Admin Logo"></a>
        </div>
        <div class="admin-info">
            <span>Hi, Admin <?php echo htmlspecialchars($adminUsername); ?>!</span>
            <button class="logout-btn" id="logoutBtn">Logout</button>
        </div>
    </header>
    
    <div class="sidebar">
        <a href="#">Dashboard</a>
        <a href="#">Recipes</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
    </div>
    
    <main>
        <h2>Manage Recipes</h2>
        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addRecipeModal">Add Recipe</button>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Recipe Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Spaghetti Carbonara</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRecipeModal">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Add Recipe Modal -->
    <div class="modal fade" id="addRecipeModal" tabindex="-1" aria-labelledby="addRecipeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Recipe Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Recipe Modal -->
    <div class="modal fade" id="editRecipeModal" tabindex="-1" aria-labelledby="editRecipeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Recipe Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById("logoutBtn").addEventListener("click", function () {
            fetch("logout.php", { method: "POST" })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        window.location.href = "login-signup.php";
                    }
                })
                .catch(error => console.error("Logout failed:", error));
        });
    </script>

</body>
</html>
