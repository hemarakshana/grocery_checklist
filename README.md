# Grocery Checklist

The **Grocery Checklist** is a web-based application designed to help users manage and check their grocery items efficiently. Built using PHP and SQL, this tool allows users to create, update, and review their grocery lists with ease.

## Features
- Add, edit, or delete grocery items.
- Mark items as purchased or pending.
- User-friendly interface for managing grocery lists.
- Database-backed persistence to save grocery data.

## Prerequisites
- A local server environment like XAMPP.
- PHP 7.4 or higher.
- MySQL or any SQL-compatible database.

## Installation
1. **Clone the Repository**  
   Clone this repository to your local machine using:
   ```bash
   git clone https://hemarakshana.github.io/grocery_checklist/
   ```

2. **Set Up the Database**  
   - Import the `grocery_list.sql` file into your database management tool (e.g., phpMyAdmin).
   - Update the database configuration in the `index.php` file as required:
     ```php
     $servername = "your_server_name";
     $username = "your_username";
     $password = "your_password";
     $dbname = "grocery_list_database";
     ```

3. **Run the Application**  
   - Place the files in your server's root directory (e.g., `htdocs` for XAMPP).
   - Access the application by navigating to `http://localhost/index.php` in your browser.

## Usage
1. Add items to the grocery list by filling in the form.
2. Check items off as you purchase them.
3. Update or delete items as needed.

## Technologies Used
- **PHP**: For server-side scripting.
- **SQL**: For managing the database.
- **HTML/CSS/JavaScript**: For the user interface.

## License
This project is licensed under the HR License. See the `LICENSE` file for more details.

