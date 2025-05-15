# Expense Tracker Website

A simple expense tracking application built with PHP, MySQL, jQuery, and AJAX. This application allows users to manage their expenses with basic CRUD operations.

## Prerequisites

- PHP (>= 7.0)
- MySQL
- Web server (Apache/XAMPP/MAMP)
- Git

## Installation

1. Clone the repository
```bash
git clone <your-repository-url>
cd expense-tracker
```

2. Set up the database
- Open MySQL terminal or phpMyAdmin
- Create a new database and table:
CREATE DATABASE `expense-tracker`;
USE `expense-tracker`;

CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

3. Configure database connection
- Open config.php
- Update the database credentials if needed:
$host = 'localhost';
$dbname = 'expense-tracker';
$username = 'root';
$password = 'your_password';

## Usage
1. Start your local web server (XAMPP/MAMP)
2. Open the project in your web browser:
   - If using XAMPP: http://localhost/expense-tracker
   - If using MAMP: http://localhost:8888/expense-tracker
## Features
- Add new expenses
- View all expenses in a table format
- Edit existing expenses
- Delete expenses
- Categorize expenses
- Real-time updates using AJAX

## Development
To contribute to this project:

1. Fork the repository
git fork <original-repository-url>
2. Create a new branch for your feature or bug fix
git checkout -b feature/your-feature-name

3. Make your changes and commit them
git add .
git commit -m "Add your commit message"

4. Push your changes to your fork
git push origin feature/your-feature-name

5. Create a Pull Request