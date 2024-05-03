# Laravel Application Documentation

This document provides instructions for setting up and understanding the features of the Laravel application. The application implements the following features:

1. **User Authentication**
2. **Task Listing**
3. **Task Assignment**
4. **User-Specific Task Lists**

## Setup

### Prerequisites
- XAMPP or any other local server environment
- MySQL
- PHP
- Composer

### Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/your-repo.git

2. **Install Composer Dependencies**
    ```bash
    composer install
    
3. **Setup .env file**
   
4. **Run Database Migrations and Seeders**

   Alternatively you can manually define the email and password in the DatabaseSeeder.php in case the automatic seeder didn't work
   Here is how you can do:
   ```bash
    public function run()
    {
        // Create a default user
        User::create([
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
    }

Seed the Database by running:
php artisan migrate --seed



5. **Start the Development Server and Access the Application**
Run the app by:
php artisan serve

And access your app at the localhost:8000


# Features

1. **User Authentication**
   - Implements a login mechanism.
   - Signup API is not required. A seeder is provided to insert dummy users into the database.

2. **Task Listing**
   - Retrieves a list of tasks with options for filtering by status, date, and assigned user.
   - Implements functionalities for creating, updating, and deleting tasks.

3. **Task Assignment**
   - Allows the assignment of multiple users to a task.
   - Provides the ability to unassign a user from a task.
   - Allows users to change the status of a task.

4. **User-Specific Task Lists**
   - Provides a list of tasks assigned to a particular user.
   - Displays a list of tasks assigned to the currently logged-in user.

## Known Issue

- The application may encounter issues with getting the currently logged-in user by auth token. This issue is under investigation and will be resolved in a future update.

## Additional Notes

- For further customization and understanding of the application, refer to the Laravel documentation: [https://laravel.com/docs](https://laravel.com/docs)
- Explore the application's codebase located in the `app` directory to understand the implementation details.



##By Kumail Rizvi
