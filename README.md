# Gestion Projet - Project Management Application

[![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![CakePHP](https://img.shields.io/badge/CakePHP-5.2.6-orange.svg)](https://cakephp.org)

A comprehensive web-based project management application built with CakePHP 5.2.6, designed to manage projects, personnel, tasks, and assignments efficiently. This application supports user authentication, role-based access control, and data export functionalities.

## ✨ Features

### 🔐 Authentication and User Management

-   User registration and login
-   Role-based access control (Admin and User roles)
-   Secure password hashing

### 👥 Personnel Management

-   CRUD operations for personnel (staff members)
-   Link personnel to functions (job roles)
-   Contact information management

### 🏢 Function Management

-   Define and manage job roles/functions

### 📋 Project Management

-   Create, edit, view, and delete projects
-   Project details include name, description, start/end dates

### 🔗 Project Assignment Management (GestionProjets)

-   Assign projects to personnel via many-to-many relationships
-   Track project-personnel associations

### ✅ Task Management

-   Manage tasks associated with project assignments
-   Track task progress (decimal-based progress indicator)
-   Task details: title, dates, progress status

### 📊 Dashboard (Main Page)

-   Search projects by date range
-   Display project details with associated personnel and tasks
-   Export data to Excel (CSV) or PDF formats
-   Add custom notes to exports

### 🎨 Additional Features

-   Responsive UI with Milligram CSS framework
-   Flash messages for user feedback
-   Data validation and security measures
-   Migration-based database schema management

## 🚀 Quick Start

### Prerequisites

-   PHP 8.1 or higher
-   Composer
-   MySQL or PostgreSQL database
-   Web server (Apache/Nginx) with mod_rewrite enabled

### Installation

1. **Clone the repository**:

    ```bash
    git clone https://github.com/doniadk/gestion-projet.git
    cd gestion-projet
    ```

2. **Install dependencies**:

    ```bash
    composer install
    ```

3. **Set up the database**:

    - Create a new database in MySQL/PostgreSQL
    - Copy `config/app_local.example.php` to `config/app_local.php`
    - Update `config/app_local.php` with your database credentials

4. **Run database migrations**:

    ```bash
    bin/cake migrations migrate
    ```

5. **Start the development server**:
    ```bash
    bin/cake server
    ```
    Visit `http://localhost:8765` to access the application.

## 📖 Usage

1. **Access the Application**: Navigate to the root URL.
2. **Sign Up/Login**: Create an account or log in.
3. **Dashboard**: Use the main page to search projects by date and export data.
4. **Manage Entities**: Admins can access CRUD interfaces for users, personnels, functions, projects, assignments, and tasks via the navigation.
5. **Exports**: On the dashboard, select a date, add notes, and download Excel or PDF reports.

### User Roles

-   **Admin**: Full access to all features.
-   **User**: Limited to dashboard, view-only for personnels/projects, and exports.

## 🗄️ Database Schema

The application uses the following main tables:

-   `users`: User accounts
-   `personnels`: Staff members
-   `fonctions`: Job roles
-   `projets`: Projects
-   `gestion_projets`: Project assignments
-   `gestion_projets_personnels`: Junction table for assignments
-   `taches`: Tasks

Run migrations to set up the schema.


### Other Platforms

-   **Heroku**: Similar to Render, use PHP buildpack and set environment variables.
-   **Local Server**: Use Apache/Nginx with the provided `.htaccess` files.

## 🛠️ Technologies Used

-   **Framework**: CakePHP 5.2.6
-   **Frontend**: HTML, CSS (Milligram), JavaScript, Font Awesome
-   **Backend**: PHP 8.1+
-   **Database**: MySQL/PostgreSQL with CakePHP ORM
-   **Libraries**: Dompdf (PDF generation), MobileDetect
-   **Tools**: Composer, PHPUnit (testing), PHPCS/PHPStan (code quality)

## 🙏 Acknowledgments

-   [CakePHP](https://cakephp.org) for the framework
-   [Milligram](https://milligram.io/) for the CSS framework
-   [Dompdf](https://github.com/dompdf/dompdf) for PDF generation
