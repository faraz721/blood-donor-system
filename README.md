Welcome to the Blood Donor System! This simple website connects blood donors with people who need blood. It has a clean red-and-white design, fun animations (like sliding buttons and a pulsing logo), and works great on phones and computers.
Features

Homepage: Three buttons to become a donor, search donors, or log in as admin. Buttons bounce when they load!
Become a Donor: Form to enter:
Name, blood group (e.g., A+, O-), age (18–60), city, ph# 🩸 Blood Donor System

Welcome to the **Blood Donor System**!  
This is a simple yet dynamic website that connects **blood donors** with people in need.  
It features a clean **red-and-white design**, responsive layout, and smooth animations.

---

## 🚀 Features

- **Homepage**  
  - Three main buttons: Become a Donor, Search Donors, Admin Login  
  - Buttons bounce on load for a friendly look

- **Become a Donor**  
  - Fill in details:  
    - Name, Blood Group (e.g., A+, O-), Age (18–60), City, Phone  
    - Email and WhatsApp (optional)  
  - Contact links open apps directly (e.g., WhatsApp, Email)

- **Search Donors**  
  - Search by **city** or **blood group**  
  - View all donors in a table with clickable contact options

- **Admin Panel**  
  - Login with password: `admin123`  
  - View or delete single/multiple donors

- **About Us**  
  - Explains the mission to help people in emergencies

- **Contact Page**  
  - Shows developer's photo (zoom on hover)  
  - Includes clickable links for:
    - Email  
    - LinkedIn  
    - Instagram  
    - WhatsApp

- **Animations**  
  - Sliding headers, pulsing logo, hover effects, bouncing buttons

---

## 🛠️ Technologies Used

- **PHP** — Backend (forms, search, admin)
- **MySQL** — Stores donor & admin data
- **HTML/CSS** — Layout & styling (red-and-white theme, Poppins font)
- **JavaScript** — Animations & input validations

---

## ⚙️ How to Set Up (Localhost)

### 1. Clone the Repository

Install Git: [https://git-scm.com/downloads](https://git-scm.com/downloads)

```bash
git clone https://github.com/faraz721/blood-donor-system.git
cd blood-donor-system
```

---

### 2. Install XAMPP

Download & install XAMPP: [https://www.apachefriends.org](https://www.apachefriends.org)

Open XAMPP Control Panel and start **Apache** and **MySQL**

---

### 3. Set Up the Database

1. Go to `http://localhost/phpmyadmin`
2. Create a database:
   - Click **New**
   - Name it `blood_donor_db`
   - Click **Create**

3. Run SQL code to create tables:

```sql
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
```

4. Generate Admin Password:

Create a new file named `hash_password.php` in your project folder with the following code:

```php
<?php
$password = "admin123";
echo password_hash($password, PASSWORD_DEFAULT);
?>
```

- Open in browser: `http://localhost/blood-donor-system/hash_password.php`
- Copy the hashed password

5. Insert into the `admin` table:

- Go to `blood_donor_db > admin > Insert`
- Add:
  - `id`: 1  
  - `password`: *Paste the hash*  
- Click **Go**

> **Note:** Delete `hash_password.php` after use.

---

### 4. Move Files to XAMPP

- Copy the entire folder to:

```
C:\xampp\htdocs\blood-donor-system\
```

- Ensure `me.jpg` is placed in:

```
C:\xampp\htdocs\blood-donor-system\media\
```

---

### 5. Test the Website

Open in browser:

```
http://localhost/blood-donor-system/
```

Test the following pages:

- Home → `/index.php`
- About Us → `/about.php`
- Contact → `/contact.php`
- Become a Donor → `/donor_form.php`
- Search Donors → `/search_donors.php`
- Admin Login → `/admin_login.php` → use `admin123`

---

### 6. Use the Website

- **Become a Donor:**  
  - Age must be 18–60  
  - Phone should be valid (`+923001234567`)  
- **Search Donors:**  
  - Filter by blood group or city  
- **Admin Panel:**  
  - View or delete donor records  
- **Contact Page:**  
  - Try all contact links

---

## 🧰 Troubleshooting

- **Website doesn’t load?**  
  - Make sure Apache and MySQL are running in XAMPP

- **Database errors?**  
  - Check `config.php`:
    ```php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_donor_db";
    ```

- **Admin login fails?**  
  - Make sure hashed password for `admin123` is correctly inserted

- **Image not showing?**  
  - Confirm `me.jpg` exists in the `/media` folder

---

## 📬 Contact

Reach out to **Ahmed Faraz Malik**:

- 📧 Email: [721ahmedfarazmalik@gmail.com](mailto:721ahmedfarazmalik@gmail.com)  
- 🔗 LinkedIn: [linkedin.com/in/ahmed-faraz-malik-88b635319](https://linkedin.com/in/ahmed-faraz-malik-88b635319)  
- 📸 Instagram: [instagram.com/farazzz.malik](https://instagram.com/farazzz.malik)
