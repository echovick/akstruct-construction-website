# AKStruct Construction Website CMS Documentation

## Table of Contents

1. [Database Structure](#database-structure)
2. [Sitemap](#sitemap)
3. [Menu Structure](#menu-structure)
4. [Content Types](#content-types)
5. [User Roles & Permissions](#user-roles--permissions)

## Database Structure

### Core Tables

#### users

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id BIGINT UNSIGNED NOT NULL,
    remember_token VARCHAR(100),
    email_verified_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### roles

```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### permissions

```sql
CREATE TABLE permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### role_permissions

```sql
CREATE TABLE role_permissions (
    role_id BIGINT UNSIGNED NOT NULL,
    permission_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);
```

### Content Management Tables

#### projects

```sql
CREATE TABLE projects (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    category_id BIGINT UNSIGNED NOT NULL,
    client VARCHAR(255),
    location VARCHAR(255),
    completion_date DATE,
    project_value DECIMAL(15,2),
    featured_image VARCHAR(255),
    description TEXT,
    challenge TEXT,
    solution TEXT,
    status ENUM('planning', 'in_progress', 'completed', 'on_hold') DEFAULT 'in_progress',
    meta_title VARCHAR(255),
    meta_description TEXT,
    published BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP NULL,
    created_by BIGINT UNSIGNED NOT NULL,
    updated_by BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (updated_by) REFERENCES users(id)
);
```

#### project_images

```sql
CREATE TABLE project_images (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    project_id BIGINT UNSIGNED NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    caption TEXT,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);
```

#### services

```sql
CREATE TABLE services (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    icon VARCHAR(255),
    short_description TEXT,
    detailed_description TEXT,
    featured_image VARCHAR(255),
    meta_title VARCHAR(255),
    meta_description TEXT,
    published BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP NULL,
    created_by BIGINT UNSIGNED NOT NULL,
    updated_by BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id),
    FOREIGN KEY (updated_by) REFERENCES users(id)
);
```

#### service_features

```sql
CREATE TABLE service_features (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    service_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon VARCHAR(255),
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);
```

#### blog_posts

```sql
CREATE TABLE blog_posts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT,
    featured_image VARCHAR(255),
    excerpt TEXT,
    meta_title VARCHAR(255),
    meta_description TEXT,
    published BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP NULL,
    author_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);
```

#### categories

```sql
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    parent_id BIGINT UNSIGNED NULL,
    type ENUM('project', 'blog', 'service') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL
);
```

#### tags

```sql
CREATE TABLE tags (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### taggables

```sql
CREATE TABLE taggables (
    tag_id BIGINT UNSIGNED NOT NULL,
    taggable_id BIGINT UNSIGNED NOT NULL,
    taggable_type VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (tag_id, taggable_id, taggable_type),
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);
```

#### team_members

```sql
CREATE TABLE team_members (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    department VARCHAR(255),
    image VARCHAR(255),
    bio TEXT,
    email VARCHAR(255),
    phone VARCHAR(50),
    social_links JSON,
    sort_order INT DEFAULT 0,
    published BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### testimonials

```sql
CREATE TABLE testimonials (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255) NOT NULL,
    company VARCHAR(255),
    image VARCHAR(255),
    rating TINYINT UNSIGNED,
    testimonial_text TEXT NOT NULL,
    project_id BIGINT UNSIGNED,
    published BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL
);
```

#### career_listings

```sql
CREATE TABLE career_listings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    position_title VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    job_type ENUM('full_time', 'part_time', 'contract', 'internship') NOT NULL,
    experience_level VARCHAR(255),
    requirements TEXT,
    responsibilities TEXT,
    benefits TEXT,
    application_process TEXT,
    salary_range VARCHAR(255),
    published BOOLEAN DEFAULT TRUE,
    closing_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### media_library

```sql
CREATE TABLE media_library (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(50) NOT NULL,
    mime_type VARCHAR(100) NOT NULL,
    size BIGINT UNSIGNED NOT NULL,
    alt_text VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    uploaded_by BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);
```

#### settings

```sql
CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    group VARCHAR(255) NOT NULL,
    key VARCHAR(255) NOT NULL,
    value TEXT,
    type VARCHAR(50) DEFAULT 'string',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_group_key (group, key)
);
```

## Sitemap

### Public Pages

```
Homepage (/)
├── About (/about)
│   └── Team (/about/team)
├── Services (/services)
│   └── Individual Service Pages (/services/{slug})
├── Projects (/projects)
│   ├── Project Categories (/projects/categories/{slug})
│   └── Individual Project Pages (/projects/{slug})
├── Blog (/blog)
│   ├── Blog Categories (/blog/categories/{slug})
│   └── Individual Blog Posts (/blog/{slug})
├── Careers (/careers)
│   └── Job Listings (/careers/{slug})
├── Contact (/contact)
├── Request Quote (/quote)
├── Testimonials (/testimonials)
└── Legal
    ├── Privacy Policy (/privacy-policy)
    └── Terms of Service (/terms-of-service)
```

### Admin Pages

```
Dashboard (/admin)
├── Projects
│   ├── All Projects (/admin/projects)
│   ├── Add Project (/admin/projects/create)
│   ├── Edit Project (/admin/projects/{id}/edit)
│   └── Categories (/admin/projects/categories)
├── Services
│   ├── All Services (/admin/services)
│   ├── Add Service (/admin/services/create)
│   └── Edit Service (/admin/services/{id}/edit)
├── Blog
│   ├── All Posts (/admin/blog)
│   ├── Add Post (/admin/blog/create)
│   ├── Edit Post (/admin/blog/{id}/edit)
│   └── Categories (/admin/blog/categories)
├── Team
│   ├── All Members (/admin/team)
│   ├── Add Member (/admin/team/create)
│   └── Edit Member (/admin/team/{id}/edit)
├── Careers
│   ├── Job Listings (/admin/careers)
│   ├── Add Listing (/admin/careers/create)
│   └── Applications (/admin/careers/applications)
├── Media Library (/admin/media)
├── Users & Permissions
│   ├── Users (/admin/users)
│   ├── Roles (/admin/roles)
│   └── Permissions (/admin/permissions)
└── Settings
    ├── General (/admin/settings/general)
    ├── SEO (/admin/settings/seo)
    ├── Contact Info (/admin/settings/contact)
    └── Social Media (/admin/settings/social)
```

## Menu Structure

### Public Navigation

```
Main Menu
├── Home
├── About
│   ├── Company Overview
│   ├── Team
│   └── Testimonials
├── Services
│   └── [Dynamic Service Categories]
├── Projects
│   └── [Dynamic Project Categories]
├── Blog
├── Careers
└── Contact

Footer Menu 1 (Company)
├── About Us
├── Team
├── Careers
└── Contact

Footer Menu 2 (Services)
└── [Dynamic Service List]

Footer Menu 3 (Resources)
├── Blog
├── Projects
├── Request Quote
└── FAQ

Footer Menu 4 (Legal)
├── Privacy Policy
├── Terms of Service
└── Sitemap
```

### Admin Navigation

```
Main Sidebar
├── Dashboard
├── Projects
│   ├── All Projects
│   ├── Add New
│   └── Categories
├── Services
│   ├── All Services
│   └── Add New
├── Blog
│   ├── All Posts
│   ├── Add New
│   └── Categories
├── Team
│   ├── All Members
│   └── Add New
├── Careers
│   ├── Job Listings
│   └── Applications
├── Media Library
├── Users & Permissions
│   ├── Users
│   ├── Roles
│   └── Permissions
└── Settings
    ├── General
    ├── SEO
    ├── Contact Info
    └── Social Media
```

## User Roles & Permissions

### Role Hierarchy

1. Super Admin

    - Full system access
    - Manage roles and permissions
    - Access to all features

2. Content Manager

    - Manage all content types
    - Access to media library
    - Cannot manage users/roles

3. Editor

    - Create/edit content
    - Cannot delete content
    - Limited settings access

4. Author

    - Create/edit own content
    - Cannot delete content
    - No settings access

5. Client Service Rep
    - View projects/services
    - Manage testimonials
    - Handle contact forms

### Permission Groups

#### Content Management

-   create_content
-   edit_content
-   delete_content
-   publish_content
-   manage_categories
-   manage_tags

#### Media Library

-   upload_media
-   edit_media
-   delete_media
-   view_media

#### User Management

-   create_users
-   edit_users
-   delete_users
-   assign_roles

#### System Settings

-   manage_settings
-   manage_seo
-   manage_menus
-   view_analytics

#### Project Management

-   create_projects
-   edit_projects
-   delete_projects
-   manage_project_status

#### Career Management

-   post_jobs
-   edit_jobs
-   delete_jobs
-   view_applications
-   manage_applications
