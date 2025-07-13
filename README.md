Blood Donor System
Welcome to the Blood Donor System! This simple website connects blood donors with people who need blood. It has a clean red-and-white design, fun animations (like sliding buttons and a pulsing logo), and works great on phones and computers.
Features

Homepage: Three buttons to become a donor, search donors, or log in as admin. Buttons bounce when they load!
Become a Donor: Form to enter:
Name, blood group (e.g., A+, O-), age (18–60), city, phone (like +923001234567).
Email and WhatsApp are optional.
Contact links open your phone, email, or WhatsApp app.


Search Donors: Search by city or blood group, or see all donors in a table. Click to contact.
Admin Panel: Log in with admin123 to view or delete donors (single or multiple).
About Us: Explains the mission to help people.
Contact: Shows developer’s photo (hover for zoom) and links for Email, LinkedIn, Instagram, WhatsApp.
Animations: Sliding headers, pulsing logo, bouncing buttons, and hover effects.

Technologies Used

PHP: Runs the website (forms, searches, admin tasks).
MySQL: Stores donor and admin data.
HTML/CSS: Creates the look (red-and-white theme, Poppins font).
JavaScript: Powers animations and form checks (like valid phone numbers).

How to Set Up
Follow these steps to run the website on your computer.
1. Clone the Repository

Install Git from https://git-scm.com/downloads.

Open a terminal (Git Bash on Windows) and run:
git clone https://github.com/faraz721/blood-donor-system.git


Move to the project folder:
cd blood-donor-system



2. Install XAMPP

Download XAMPP from https://www.apachefriends.org/ and install it.
Open XAMPP Control Panel and start Apache and MySQL (they turn green).

3. Set Up the Database

Go to http://localhost/phpmyadmin in your browser.
Create a database:
Click New on the left.
Name it blood_donor_db and click Create.


Create tables:
Click the SQL tab.

Copy and paste this code, then click Go:
USE blood_donor_db;

CREATE TABLE donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    blood_group VARCHAR(3) NOT NULL,
    age INT NOT NULL,
    city VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100),
    whatsapp VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);




Set the admin password (admin123):
Create a file named hash_password.php in the project folder:
<?php
$password = "admin123";
echo password_hash($password, PASSWORD_DEFAULT);
?>


Open http://localhost/blood-donor-system/hash_password.php, copy the hash.

In phpMyAdmin, go to blood_donor_db > admin table, click Insert, and add:

id: 1
password: Paste the hash


Click Go. Delete hash_password.php after use.




4. Move Files to XAMPP

Copy the blood-donor-system folder to C:\xampp\htdocs\.
Ensure me.jpg is in C:\xampp\htdocs\blood-donor-system\media.

5. Test the Website

Open http://localhost/blood-donor-system/ in your browser.
Check all pages:
Home: /index.php
About Us: /about.php
Contact: /contact.php (verify me.jpg shows with hover effect)
Become a Donor: /donor_form.php
Search Donors: /search_donors.php
Admin Login: /admin_login.php (use admin123)


Test admin login with admin123.

6. Use the Website

Become a Donor: Fill the form (age 18–60, valid phone). Click Submit.
Search Donors: Search by city or blood group. Click contact links.
Admin Panel: Log in with admin123 to view or delete donors.
Contact: Click Email, LinkedIn, Instagram, or WhatsApp links.

Troubleshooting

Website doesn’t load: Ensure Apache and MySQL are running in XAMPP.

Database error: Check config.php has:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donor_db";


Admin login fails: Verify the admin table has the correct hash for admin123.

Photo missing: Ensure me.jpg is in the media folder.


Contact
Reach out to Ahmed Faraz Malik:

Email: 721ahmedfarazmalik@gmail.com
LinkedIn: linkedin.com/in/ahmed-faraz-malik-88b635319
Instagram: instagram.com/farazzz.malik
