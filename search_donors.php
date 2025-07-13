<?php
require 'config.php';
$donors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = trim($_POST['city']);
    $blood_group = $_POST['blood_group'];
    $sql = "SELECT * FROM donors WHERE 1=1";
    $params = [];
    $types = "";
    if (!empty($city)) {
        $sql .= " AND city LIKE ?";
        $params[] = "%$city%";
        $types .= "s";
    }
    if (!empty($blood_group)) {
        $sql .= " AND blood_group = ?";
        $params[] = $blood_group;
        $types .= "s";
    }
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $donors = $stmt->get_result();
    $stmt->close();
} else {
    $sql = "SELECT * FROM donors";
    $donors = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Donors - Blood Donor System</title>
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
            max-width: 800px;
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
            margin-bottom: 2rem;
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
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            animation: fadeIn 1.5s ease-out;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
        }
        th {
            background: #b22222;
            color: white;
            font-weight: 600;
        }
        tr {
            transition: background 0.3s ease;
        }
        tr:hover {
            background: #fff5f5;
            transform: scale(1.01);
        }
        .action-link {
            color: #b22222;
            text-decoration: none;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .action-link:hover {
            color: #8b1a1a;
            transform: scale(1.05);
        }
        .no-results {
            text-align: center;
            font-size: 1.1rem;
            color: #333;
            margin: 2rem 0;
            animation: fadeIn 1.5s ease-out;
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
            table {
                font-size: 0.85rem;
                display: block;
                overflow-x: auto;
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
        <h2>Search for Donors</h2>
        <form method="POST" action="">
            <label for="city"><i class="fas fa-map-marker-alt"></i> City:</label>
            <input type="text" id="city" name="city">
            <label for="blood_group"><i class="fas fa-tint"></i> Blood Group:</label>
            <select id="blood_group" name="blood_group">
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
            <input type="submit" value="Search" class="btn">
        </form>
        <?php if ($donors->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Blood Group</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>WhatsApp</th>
                </tr>
                <?php while ($row = $donors->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['city']); ?></td>
                        <td><a href="tel:<?php echo htmlspecialchars($row['phone']); ?>" class="action-link"><?php echo htmlspecialchars($row['phone']); ?></a></td>
                        <td><?php echo $row['email'] ? '<a href="mailto:' . htmlspecialchars($row['email']) . '" class="action-link">' . htmlspecialchars($row['email']) . '</a>' : '-'; ?></td>
                        <td><?php echo $row['whatsapp'] ? '<a href="https://wa.me/' . htmlspecialchars($row['whatsapp']) . '" class="action-link">' . htmlspecialchars($row['whatsapp']) . '</a>' : '-'; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="no-results">No donors found.</p>
        <?php endif; ?>
    </main>
</body>
</html>
