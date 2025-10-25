# Gestion Projet - Project Management Application

[![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![CakePHP](https://img.shields.io/badge/CakePHP-5.2.x-orange.svg)](https://cakephp.org)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://github.com/your-username/gestion-projet/actions/workflows/ci.yml/badge.svg)](https://github.com/your-username/gestion-projet/actions)

A comprehensive web-based project management application built with CakePHP 5.x, designed to manage projects, personnel, tasks, and assignments efficiently. This application supports user authentication, role-based access control, and data export functionalities.

![Application Screenshot](https://via.placeholder.com/800x400?text=Application+Screenshot) <!-- Replace with actual screenshot URL -->

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
    git clone https://github.com/your-username/gestion-projet.git
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
    bin/cake server -p 8765
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

## 🚀 Deployment

### On Render

1. Push your code to a Git repository (GitHub/GitLab).
2. Create a PostgreSQL database service on Render.
3. Create a Web Service:
    - Runtime: PHP
    - Build Command: `composer install --no-dev --optimize-autoloader`
    - Start Command: `apache2-foreground`
    - Environment Variables: Set `DEBUG=false`, `SECURITY_SALT`, `DATABASE_URL`, etc.
    - Post-Deploy Command: `./bin/post-deploy.sh` (create this script to run migrations)
4. Deploy and monitor logs.

For detailed Render deployment steps, refer to the deployment guide.

### Other Platforms

-   **Heroku**: Similar to Render, use PHP buildpack and set environment variables.
-   **Local Server**: Use Apache/Nginx with the provided `.htaccess` files.

## 🛠️ Technologies Used

-   **Framework**: CakePHP 5.2.x
-   **Frontend**: HTML, CSS (Milligram), JavaScript, Font Awesome
-   **Backend**: PHP 8.1+
-   **Database**: MySQL/PostgreSQL with CakePHP ORM
-   **Libraries**: Dompdf (PDF generation), MobileDetect
-   **Tools**: Composer, PHPUnit (testing), PHPCS/PHPStan (code quality)

## 🧪 Testing

Run tests with:

```bash
composer test
```

## 🤝 Contributing

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/AmazingFeature`).
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For issues or questions, please open an issue on the [Git repository](https://github.com/your-username/gestion-projet/issues).

## 🙏 Acknowledgments

-   [CakePHP](https://cakephp.org) for the framework
-   [Milligram](https://milligram.io/) for the CSS framework
-   [Dompdf](https://github.com/dompdf/dompdf) for PDF generation
