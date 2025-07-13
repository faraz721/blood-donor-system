<?php
require 'config.php';
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_donor'])) {
    $donor_id = (int)$_POST['donor_id'];
    $sql = "DELETE FROM donors WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $donor_id);
    if ($stmt->execute()) {
        $success = "Donor deleted successfully!";
    } else {
        $error = "Error deleting donor.";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_selected'])) {
    if (!empty($_POST['donor_ids'])) {
        $donor_ids = array_map('intval', $_POST['donor_ids']);
        $placeholders = implode(',', array_fill(0, count($donor_ids), '?'));
        $sql = "DELETE FROM donors WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat('i', count($donor_ids)), ...$donor_ids);
        if ($stmt->execute()) {
            $success = "Selected donors deleted successfully!";
        } else {
            $error = "Error deleting donors.";
        }
        $stmt->close();
    } else {
        $error = "No donors selected for deletion.";
    }
}

$sql = "SELECT * FROM donors";
$donors = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Blood Donor System</title>
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
            max-width: 1000px;
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
            margin-bottom: 2rem;
        }
        .btn {
            background: #b22222;
            color: white;
            padding: 0.8rem 1.5rem;
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
        .delete-btn {
            background: #e74c3c;
        }
        .delete-btn:hover {
            background: #c0392b;
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
            .btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
                margin: 0.3rem;
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
        <h2>Admin Panel</h2>
        <div id="notification">
            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>
        </div>
        <form method="POST" action="">
            <?php if ($donors->num_rows > 0): ?>
                <table>
                    <tr>
                        <th><input type="checkbox" id="select-all" onclick="toggleSelectAll()"></th>
                        <th>Name</th>
                        <th>Blood Group</th>
                        <th>Age</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = $donors->fetch_assoc()): ?>
                        <tr>
                            <td><input type="checkbox" name="donor_ids[]" value="<?php echo $row['id']; ?>"></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                            <td><a href="tel:<?php echo htmlspecialchars($row['phone']); ?>" class="action-link"><?php echo htmlspecialchars($row['phone']); ?></a></td>
                            <td><?php echo $row['email'] ? '<a href="mailto:' . htmlspecialchars($row['email']) . '" class="action-link">' . htmlspecialchars($row['email']) . '</a>' : '-'; ?></td>
                            <td><?php echo $row['whatsapp'] ? '<a href="https://wa.me/' . htmlspecialchars($row['whatsapp']) . '" class="action-link">' . htmlspecialchars($row['whatsapp']) . '</a>' : '-'; ?></td>
                            <td>
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="donor_id" value="<?php echo $row['id']; ?>">
                                    <input type="submit" name="delete_donor" value="Delete" class="btn delete-btn">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <input type="submit" name="delete_selected" value="Delete Selected" class="btn delete-btn">
            <?php else: ?>
                <p class="no-results">No donor records found.</p>
            <?php endif; ?>
        </form>
    </main>
    <script>
        function toggleSelectAll() {
            const checkboxes = document.querySelectorAll('input[name="donor_ids[]"]');
            const selectAll = document.getElementById('select-all');
            checkboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
        }

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