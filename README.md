# Access Control Layer (ACL) with Laravel

Access control layer designed with laravel 11 for admin panel like fillament and spatie whereas all the admin panel facilities like user managemnet, menu management, and role management are available.
## Project Details

- **GitHub Repository**: [https://github.com/shohag-cse-knu/AccessControlLayer.git](https://github.com/shohag-cse-knu/AccessControlLayer.git)

## Features

- **Login**:
- **Register**:
- **Dashboard**:
- **Report**: 
- **Settings**: 
- **User Management**: 
- **Menu Management**:
- **Role Management**:

## Prerequisites

- **Laravel**: The minimum Laravel version required for Livewire is Laravel 11.x.
- **PHP**: Livewire requires PHP version 8.2 or higher.
- **Composer**: Since Laravel is installed via Composer, make sure you have Composer installed on your system.
- **JavaScript Dependencies (NPM)**: You need to have Node.js and npm installed to manage the front-end assets.

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/shohag-cse-knu/acl.git
````
### 2. Change the .env
Modify Database name, db user and password.

### 3. Composer Update
```bash
composer update
````
### 4. Key Generate
```bash
php artisan key:generate
````
### 5. DB Migration
```bash
php artisan migrate
````
### 5. Seeding
```bash
php artisan db:seed
````
### 6. Install Vite Plugin
```bash
npm install --save-dev vite laravel-vite-plugin
````
### 7. Run NPM
```bash
npm run build
````
### 8. Run 
```bash
php artisan serve
````

## Technologies Used

- **Frontend**: HTML, CSS, Blade
- **Backend**: Laravel, MySql(You can also use other database)

## Contributing

To contribute:

1. Fork the repository.
2. Create a branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m 'Add feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Open a pull request.

## Contact

For questions or suggestions, please contact:

- **Name**: Syfur Rahaman Shohag
- **Email**: [syfur.srs@gmail.com](mailto:syfur.srs@gmail.com)
- **GitHub**: [https://github.com/shohag-cse-knu](https://github.com/shohag-cse-knu)
