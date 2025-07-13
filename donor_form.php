<?php
require 'config.php';
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $blood_group = $_POST['blood_group'];
    $age = (int)$_POST['age'];
    $city = trim($_POST['city']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $whatsapp = trim($_POST['whatsapp']);

    if (empty($name) || empty($blood_group) || empty($age) || empty($city) || empty($phone)) {
        $error = "All required fields must be filled.";
    } elseif ($age < 18 || $age > 60) {
        $error = "Age must be between 18 and 60.";
    } elseif (!preg_match("/^(?:\+92|0)[0-9]{10}$/", $phone)) {
        $error = "Phone number must be a valid Pakistani number (e.g., +923001234567 or 03001234567).";
    } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (!empty($whatsapp) && !preg_match("/^(?:\+92|0)[0-9]{10}$/", $whatsapp)) {
        $error = "WhatsApp number must be a valid Pakistani number.";
    } else {
        $sql = "INSERT INTO donors (name, blood_group, age, city, phone, email, whatsapp) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissss", $name, $blood_group, $age, $city, $phone, $email, $whatsapp);
        if ($stmt->execute()) {
            $success = "Donor registered successfully!";
        } else {
            $error = "Error registering donor.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Donor - Blood Donor System</title>
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
            max-width: 600px;
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
        input, select {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }
        input:focus, select:focus {
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
        .error, .success {
            text-align: center;
            margin: 1rem 0;
            padding: 0.8rem;
            border-radius: 6px;
            font-size: 0.95rem;
            opacity: 0;
            animation: slideIn 0.5s forwards;
        }
        .error {
            background: #e74c3c;
            color: white;
        }
        .success {
            background: #2ecc71;
            color: white;
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
        <h2>Become a Donor</h2>
        <div id="notification">
            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>
        </div>
        <form method="POST" action="" onsubmit="showLoader()">
            <label for="name"><i class="fas fa-user"></i> Full Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="blood_group"><i class="fas fa-tint"></i> Blood Group:</label>
            <select id="blood_group" name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
            <label for="age"><i class="fas fa-calendar-alt"></i> Age (18-60):</label>
            <input type="number" id="age" name="age" min="18" max="60" required>
            <label for="city"><i class="fas fa-map-marker-alt"></i> City:</label>
            <input type="text" id="city" name="city" required>
            <label for="phone"><i class="fas fa-phone"></i> Phone Number (e.g., +923001234567):</label>
            <input type="tel" id="phone" name="phone" pattern="^(?:\+92|0)[0-9]{10}$" required>
            <label for="email"><i class="fas fa-envelope"></i> Email (Optional):</label>
            <input type="email" id="email" name="email">
            <label for="whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp Number (Optional):</label>
            <input type="tel" id="whatsapp" name="whatsapp" pattern="^(?:\+92|0)[0-9]{10}$">
            <input type="submit" value="Submit" class="btn">
        </form>
        <div class="loader" id="loader"></div>
    </main>
    <script>
        function showLoader() {
            document.getElementById('loader').style.display = 'block';
            document.querySelector('form').style.opacity = '0.5';
            setTimeout(() => {
                document.getElementById('loader').style.display = 'none';
                document.querySelector('form').style.opacity = '1';
            }, 1000);
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            const age = document.getElementById('age').value;
            const phone = document.getElementById('phone').value;
            const whatsapp = document.getElementById('whatsapp').value;
            const phoneRegex = /^(?:\+92|0)[0-9]{10}$/;

            if (age < 18 || age > 60) {
                e.preventDefault();
                showNotification('Age must be between 18 and 60.', 'error');
                return;
            }
            if (!phoneRegex.test(phone)) {
                e.preventDefault();
                showNotification('Phone number must be a valid Pakistani number (e.g., +923001234567 or 03001234567).', 'error');
                return;
            }
            if (whatsapp && !phoneRegex.test(whatsapp)) {
                e.preventDefault();
                showNotification('WhatsApp number must be a valid Pakistani number.', 'error');
                return;
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
    <style>
        .loader {
            display: none;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #b22222;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 1rem auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</body>
</html>