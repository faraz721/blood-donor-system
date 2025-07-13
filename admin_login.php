<?php
require 'config.php';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $sql = "SELECT password FROM admin WHERE id = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = true;
            header("Location: admin_panel.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Blood Donor System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #ffffff, #ffe5e5);
            min-height: 100vh;
            overflow-x: hidden;
        }
        nav {
            background: #b22222;
            color: white;
            padding: 1.5rem 2rem;
            text-align: center;
            animation: slideDown 1s ease-out;
        }
        .logo {
            font-size: 2.2rem;
            font-weight: 700;
            animation: pulse 2s infinite;
        }
        .nav-links {
            list-style: none;
            margin-top: 1rem;
        }
        .nav-links li {
            display: inline-block;
            margin: 0 1.5rem;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .nav-links a:hover {
            color: #ffd700;
            transform: scale(1.1);
        }
        main {
            max-width: 400px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        h2 {
            color: #b22222;
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1.5rem;
            animation: slideUp 1s ease-out;
        }
        form {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: bounceIn 1s ease-out;
        }
        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: #333;
            animation: fadeIn 1.5s ease-out;
        }
        input {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }
        input:focus {
            border-color: #b22222;
            box-shadow: 0 0 8px rgba(178, 34, 34, 0.2);
            outline: none;
            transform: scale(1.02);
        }
        .btn {
            background: #b22222;
            color: white;
            padding: 0.8rem;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        }
        .btn:hover {
            background: #8b1a1a;
            transform: translateY(-3px);
        }
        .error {
            text-align: center;
            margin: 1rem 0;
            padding: 0.8rem;
            border-radius: 6px;
            font-size: 0.95rem;
            background: #e74c3c;
            color: white;
            opacity: 0;
            animation: slideIn 0.5s forwards;
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        @media (max-width: 768px) {
            .logo {
                font-size: 1.8rem;
            }
            .nav-links li {
                margin: 0 1rem;
            }
            .nav-links a {
                font-size: 1rem;
            }
            form {
                padding: 1.5rem;
            }
            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Blood Donor System</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
    <main>
        <h2>Admin Login</h2>
        <div id="notification">
            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </div>
        <form method="POST" action="">
            <label for="password"><i class="fas fa-lock"></i> Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login" class="btn">
        </form>
    </main>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            if (!password) {
                e.preventDefault();
                showNotification('Password is required.', 'error');
            }
        });

        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.innerHTML = `<p class="${type}">${message}</p>`;
            setTimeout(() => {
                notification.innerHTML = '';
            }, 5000);
        }
    </script>
</body>
</html>
