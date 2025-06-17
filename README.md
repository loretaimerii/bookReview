A Project To Review Books

A simple project to add a review for a book.

Setup Instructions
1. Requirements:
PHP (version 7.x or higher) Composer MySQL or a compatible database Laravel

2. Steps to Setup the Project
1. Clone the repository: git clone https://github.com/loretaimerii/bookReview.git
   cd bookReview
2. Install dependencies: Use Composer to install all required packages: composer install
3. Configure environment variables: Copy the .env.example file to .env: cp .env.example .env, and configure the database connection, chnange these lines
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bookReview
   DB_USERNAME=root
   DB_PASSWORD=
4. Generate application key: Run the following command to generate an application key: php artisan key:generate
5. Set up the database: Run the migrations to create the necessary database tables: php artisan migrate
6. Generate fake data using seeders: php artisan migrate --seed
7. Run the application: Start the application locally using: php artisan 
 
Project Structure
app/: Contains the application's core logic, including models and controllers. resources/views/: Contains the Blade template views for rendering the HTML. routes/web.php: Defines the routes for the application (e.g., home, register, login). database/migrations/: Contains the migration files used to create and update the database schema.

Features implemented
Adding a review for a book.
Filtering books by title.
Searching for most popular or highest rated books.
