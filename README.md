# My Digital Profile

A PHP-based web application that allows users to register, log in, manage their profiles, and perform basic tasks like using a calculator. The application uses a MySQL database for data storage.

---

## Features

- **User Registration**: Users can register with their personal details, including uploading a profile picture and CV.
- **User Login**: Secure login with password hashing.
- **Profile Management**: Users can view, edit, and delete their profiles.
- **Social Media Links**: Users can add and display links to their social media profiles.
- **Calculator**: A simple calculator for basic arithmetic operations.

---

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- A local server environment like XAMPP, WAMP, or MAMP

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/my-digital-profile.git
   ```
2. Place the project files in your server's root directory:
   - For XAMPP: `C:/xampp/htdocs/my-digital-profile`
   - For WAMP: `C:/wamp/www/my-digital-profile`
3. Start your local server and MySQL.

4. Create the database:
   - Open your database management tool (e.g., phpMyAdmin).
   - Run the following SQL commands:
     ```sql
     CREATE DATABASE mydigitalprofile;

     USE mydigitalprofile;

     CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(100) NOT NULL,
         date_of_birth DATE NOT NULL,
         phone VARCHAR(15) NOT NULL,
         address TEXT NOT NULL,
         email VARCHAR(100) UNIQUE NOT NULL,
         password VARCHAR(255) NOT NULL,
         image VARCHAR(255),
         cv VARCHAR(255),
         facebook VARCHAR(255),
         instagram VARCHAR(255),
         linkedin VARCHAR(255),
         github VARCHAR(255)
     );
     ```

5. Update the database configuration:
   - Open `db_config.php` and update the credentials:
     ```php
     $host = 'localhost';
     $dbname = 'mydigitalprofile';
     $username = 'root';
     $password = 'your-password';
     ```

6. Test the application:
   - Open your browser and navigate to `http://localhost/my-digital-profile/index.php`. (Put port number after localhost. localhost:----/my-digital-profile)

---

## Usage

### Registration
1. Navigate to the registration page.
2. Fill in your details and upload optional files (profile picture and CV).
3. Submit the form to create your account.

### Login
1. Navigate to the login page.
2. Enter your email and password.
3. Access your profile upon successful login.

### Profile Management
- **View Profile**: See your personal details and uploaded files.
- **Edit Profile**: Update your details, including re-uploading files.
- **Delete Profile**: Permanently delete your account.

### Calculator
- Perform basic arithmetic operations like addition, subtraction, multiplication, and division.

---

## File Structure

```
c:\Users\ituser\www\
├── db_config.php         # Database connection configuration
├── index.php             # Login page
├── registration.php      # User registration page
├── userprofile.php       # User profile page
├── editprofile.php       # Edit profile page
├── calc.php              # Calculator page
├── style.css             # Application styling
├── uploads/              # Directory for uploaded files
└── README.md             # Project documentation
```

---

## Technologies Used

- **Frontend**: HTML, CSS (via Bootstrap)
- **Backend**: PHP
- **Database**: MySQL

---
