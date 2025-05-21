# Akstruct Construction Website

A modern, full-stack Laravel web application for Akstruct Construction Ltd, showcasing their construction services, projects, and commitment to sustainable building practices.

## Tech Stack

-   Laravel 11
-   Livewire Volt for dynamic UI components
-   Tailwind CSS for styling
-   Blade templates and components
-   MySQL/PostgreSQL for database

## Features

-   Responsive, modern design with custom branding
-   Dynamic content management for all site sections
-   Project portfolio with filtering and detailed project pages
-   Services showcase with detailed descriptions
-   Blog with categories and search functionality
-   Testimonials carousel
-   Quote request form with file uploads
-   Careers section with job listings
-   Contact form with Google Maps integration
-   Admin dashboard for content management

## Installation

### Prerequisites

-   PHP 8.2+
-   Composer
-   Node.js and npm
-   MySQL or PostgreSQL database

### Setup Instructions

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/akstruct-website.git
    cd akstruct-website
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install
    ```

4. Create a copy of the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Configure your database in the `.env` file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=akstruct
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. Run database migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

8. Create symbolic link for storage:

    ```bash
    php artisan storage:link
    ```

9. Compile assets:

    ```bash
    npm run build
    ```

10. Start the development server:

    ```bash
    php artisan serve
    ```

11. Visit http://localhost:8000 in your browser

## Admin Access

After running the seeders, you can access the admin panel at `/admin` with the following credentials:

-   Email: admin@akstruct.com
-   Password: password

## Folder Structure

-   `app/Models/` - Eloquent models for all data types
-   `resources/views/livewire/pages/` - Volt components for each page
-   `resources/views/livewire/components/` - Reusable UI components
-   `resources/views/layout/` - Master layouts
-   `public/assets/` - Static assets (images, icons, etc.)

## Custom Theme

The website uses a custom color palette that reflects Akstruct's brand identity:

-   Primary: `#132D3A` (dark blue)
-   Primary Dark: `#000D1D` (darker blue)
-   Primary Light: `#2D4654` (medium blue)
-   Secondary: `#AED8E0` (teal)
-   Secondary Dark: `#8BC0C8` (darker teal)
-   Secondary Light: `#C5E4EA` (lighter teal)

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgements

-   Laravel Team for the amazing framework
-   Livewire and Volt for the reactive components
-   Tailwind CSS for the utility-first CSS framework
