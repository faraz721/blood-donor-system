<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Blood Donor System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            display: inline-block;
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
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            animation: fadeIn 1.5s ease-out;
        }
        .profile-section, .contact-section {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            animation: bounceIn 1s ease-out;
        }
        .profile-section img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
            border: 3px solid #b22222;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: zoomIn 1s ease-out;
        }
        .profile-section img:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(178, 34, 34, 0.3);
        }
        .profile-section h2 {
            color: #b22222;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            animation: slideUp 1s ease-out;
        }
        .profile-section p {
            color: #333;
            font-size: 1.1rem;
            line-height: 1.6;
            animation: fadeIn 1.5s ease-out;
        }
        .contact-section h3 {
            color: #b22222;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            animation: slideUp 1s ease-out;
        }
        .contact-section a {
            display: block;
            color: #b22222;
            text-decoration: none;
            font-size: 1.1rem;
            margin: 0.8rem 0;
            padding: 0.8rem;
            border: 1px solid #b22222;
            border-radius: 8px;
            transition: all 0.3s ease;
            animation: fadeIn 2s ease-out;
        }
        .contact-section a:hover {
            background: #b22222;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .contact-section a i {
            margin-right: 0.5rem;
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
        @keyframes zoomIn {
            from { transform: scale(0); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
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
            .profile-section img {
                width: 120px;
                height: 120px;
            }
            .profile-section h2 {
                font-size: 1.8rem;
            }
            .profile-section p {
                font-size: 1rem;
            }
            .contact-section h3 {
                font-size: 1.5rem;
            }
            .contact-section a {
                font-size: 1rem;
                padding: 0.6rem;
            }
            .container {
                padding: 0 1rem;
            }
            .profile-section, .contact-section {
                padding: 1.5rem;
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
        </ul>
    </nav>
    <div class="container">
        <!-- Profile Info -->
        <div class="profile-section">
            <img src="me.jpg" alt="Ahmed Faraz Malik" />
            <h2>Ahmed Faraz Malik</h2>
            <p>
                Developer of Blood Donor System — dedicated to solving real-world problems through tech.<br>
                Focused on clean design, responsive UIs, and meaningful impact.
            </p>
        </div>
        <!-- Contact Info -->
        <div class="contact-section">
            <h3>Let's Connect</h3>
            <a href="mailto:721ahmedfarazmalik@gmail.com" target="_blank">
                <i class="fa-regular fa-envelope"></i> Email
            </a>
            <a href="https://www.linkedin.com/in/ahmed-faraz-malik-88b635319" target="_blank">
                <i class="fa-brands fa-linkedin"></i> LinkedIn
            </a>
            <a href="https://www.instagram.com/farazzz.malik" target="_blank">
                <i class="fa-brands fa-instagram"></i> Instagram
            </a>
            <a href="https://wa.me/923151512720" target="_blank">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>
</body>
</html>