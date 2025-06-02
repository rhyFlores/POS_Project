<?php
session_start();
include 'dbConnection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Both fields are required.";
    } else {
        $loginQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($loginQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                // Redirect based on user role
                if ($row['role'] === 'Admin') {
                    header('Location: dashboard-menu.php');
                } elseif ($row['role'] === 'Cashier') {
                    header('Location: cashier-sales.php');
                } else {
                    $error = "Unauthorized role.";
                }
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Username not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Booker POS</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:100,200,300,400,500,600,700">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=IM+Fell+DW+Pica:ital@0;1&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   <div class="auth-container">
        <img src="uploads/booker-logo.png" alt="booker logo">
        <h2 id="form-title">Login</h2>
        <?php
            if (!empty($error)) {
                echo '<div class="feedback">' . htmlspecialchars($error) . '</div>';
            }
        ?>
        <form id="auth-form" method="POST" action="login.php">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="feedback"></div>
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        document.getElementById("auth-form").addEventListener("submit", function (e) {
            const usernameField = document.getElementById("username");
            const passwordField = document.getElementById("password");
            let valid = true;

            usernameField.classList.remove("error");
            passwordField.classList.remove("error");
            document.querySelector(".feedback").textContent = "";

            if (usernameField.value.trim() === "") {
                usernameField.classList.add("error");
                document.querySelector(".feedback").textContent = "Username is required.";
                valid = false;
            }

            if (passwordField.value.trim() === "") {
                passwordField.classList.add("error");
                document.querySelector(".feedback").textContent +=
                    valid ? "Password is required." : " and Password is required.";
                valid = false;
            }

            if (!valid) e.preventDefault();
        });

        document.getElementById("username").addEventListener("input", () => {
            document.getElementById("username").classList.remove("error");
            document.querySelector(".feedback").textContent = "";
        });

        document.getElementById("password").addEventListener("input", () => {
            document.getElementById("password").classList.remove("error");
            document.querySelector(".feedback").textContent = "";
        });
    </script> 
</body>
</html>