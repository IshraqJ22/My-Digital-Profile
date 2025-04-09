A PHP-based web application that allows users to register, log in, and manage their digital profiles. Users can upload profile pictures, CVs, and add social media links. The application also includes a simple calculator and user management features.

## Features

- **User Registration**: Users can register with their name, age, phone number, address, email, and password. Profile picture and CV uploads are optional.
- **User Login**: Secure login with hashed passwords.
- **User Profile**: Displays user details, uploaded profile picture, CV, and social media links.
- **Edit Profile**: Users can update their profile information.
- **Remove User**: Users can delete their account and all associated data.
- **Calculator**: A simple calculator for basic arithmetic operations.
- **Session Management**: Secure session handling for logged-in users.

## Technologies Used

- **Backend**: PHP
- **Frontend**: HTML, CSS
- **Styling**: Custom CSS with responsive design
- **Data Storage**: JSON file (`users.json`)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   ```
2. Navigate to the project directory:
   ```bash
   cd your-repo-name
   ```
3. Start a local PHP server:
   ```bash
   php -S localhost:8000
   ```
4. Open your browser and go to:
   ```
   http://localhost:8000
   ```

## File Structure

- **index.php**: Main entry point for the application. Handles user login and displays dynamic content based on login state.
- **registration.php**: Handles user registration and stores data in `users.json`.
- **userprofile.php**: Displays user profile details and allows account management.
- **calc.php**: A simple calculator for basic arithmetic operations.
- **style.css**: Custom CSS for styling the application.
- **users.json**: Stores user data in JSON format.

## Usage

1. **Register**:
   - Go to the registration page.
   - Fill in the required details and optionally upload a profile picture and CV.
   - Click "Register" to create an account.

2. **Login**:
   - Enter your email and password on the login page.
   - Click "Log In" to access your profile.

3. **Manage Profile**:
   - View your profile details, uploaded CV, and social media links.
   - Use the "Remove User" button to delete your account.

4. **Calculator**:
   - Access the calculator from your profile page.
   - Perform basic arithmetic operations.

## Future Enhancements

- **Database Integration**: Replace JSON file storage with a relational database like MySQL.
- **Password Reset**: Add functionality to reset forgotten passwords.
- **Profile Editing**: Allow users to update their profile information.
- **Admin Dashboard**: Add an admin panel for managing users.
