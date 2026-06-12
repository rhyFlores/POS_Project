# Booker POS System

A web-based Point of Sale (POS) system built with plain PHP and MySQL. Designed for small retail businesses to manage their daily operations — from product inventory and supplier tracking to sales transactions and receipts.

## Features

- **Authentication** — Secure login and logout for system users
- **Dashboard** — Overview of key business metrics at a glance
- **Product Management** — Add, edit, and delete products in the inventory
- **Supplier Management** — Track and manage supplier records
- **User Management** — Create and manage system user accounts
- **Purchases** — Record incoming stock and purchase transactions
- **Sales & Cashier** — Process customer transactions at the point of sale
- **Returns** — Handle product return requests
- **Receipts & Payment** — Generate receipts and handle payment processing

## Tech Stack

- **Backend:** PHP (native, no framework)
- **Database:** MySQL
- **Frontend:** HTML, CSS

## Getting Started

### Prerequisites

- PHP 7.x or higher
- MySQL / phpMyAdmin
- A local server (XAMPP, WAMP, or similar)

### Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/rhyFlores/POS_Project.git
   ```

2. Move the project folder to your server's root directory (e.g., `htdocs` for XAMPP).

3. Import the database:
   - Open phpMyAdmin
   - Create a new database (e.g., `bookerpos`)
   - Import `bookerpos_final.sql`

4. Configure the database connection in `dbConnection.php`:
   ```php
   $host = 'localhost';
   $db   = 'bookerpos';
   $user = 'root';
   $pass = '';
   ```

5. Start your local server and navigate to `http://localhost/POS_Project/login.php`.

## Project Structure

```
POS_Project/
├── uploads/                  # Uploaded product images
├── dbConnection.php          # Database connection
├── login.php / logout.php    # Authentication
├── dashboard-menu.php        # Main dashboard
├── add-product.php           # 
├── edit-product.php          # Product management
├── delete-product.php        #
├── products-menu.php         #
├── add-supplier.php          #
├── edit-supplier.php         # Supplier management
├── delete-supplier.php       #
├── suppliers-menu.php        #
├── add-user.php              #
├── edit-user.php             # User management
├── delete-user.php           #
├── users-menu.php            #
├── add-purchase.php          # Purchases
├── purchases-menu.php        #
├── cashier-sales.php         # Sales & cashier
├── sales-menu.php            #
├── return-product.php        # Returns
├── returns-menu.php          #
├── receipt.php               # Receipts
├── payment.php               # Payment processing
├── styles.css                # Stylesheet
└── bookerpos_final.sql       # Database file
```

**Rhynelle Kate Flores**
[GitHub](https://github.com/rhyFlores)
