[![CC BY-NC-SA 4.0][cc-by-nc-sa-shield]][cc-by-nc-sa]

This work is licensed under a
[Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License][cc-by-nc-sa].

[![CC BY-NC-SA 4.0][cc-by-nc-sa-image]][cc-by-nc-sa]

[cc-by-nc-sa]: http://creativecommons.org/licenses/by-nc-sa/4.0/
[cc-by-nc-sa-image]: https://licensebuttons.net/l/by-nc-sa/4.0/88x31.png
[cc-by-nc-sa-shield]: https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-lightgrey.svg

# Graf-Cedric.de

Welcome to the **Graf-Cedric.de** repository! This is a Laravel-based web application designed for game management with comprehensive admin capabilities, built using modern PHP and JavaScript technologies.

## Overview

- **Functionality**: A robust game management system with user roles, permissions, and a clean admin interface
- **Technology**: Built with Laravel 10, using Tabler for the admin UI and modern frontend tools

## How to Use

### Prerequisites

- **PHP 8.1+**: Ensure PHP is installed with required extensions
- **Composer**: For PHP dependency management
- **Node.js & NPM**: For frontend asset compilation
- **MySQL/MariaDB**: For database management

### Installation

1. **Clone this repository**:
   
   git clone [repository-url]
   cd cedric-beta
   

2. **Setup**:
   - Create environment file:
     
     cp .env.example .env
     
   - Configure your database and application settings in `.env`

3. **Install Dependencies**:
   
   composer install
   npm install
   

4. **Application Setup**:
   
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   npm run build
   

### Core Dependencies

#### Backend (composer.json):
- **Laravel Framework**: ^10.0
- **Laravel Sanctum**: ^3.2
- **Spatie Laravel Permission**: ^6.10
- **Tablar**: 10.0 (Admin UI)

#### Frontend (package.json):
- **@tabler/core**: ^1.0.0-beta20
- **@tabler/icons**: ^2.47.0
- **Bootstrap**: 5.3.1
- **jQuery**: 3.7.*
- **Sass**: ~1.64.2
- **Vite**: ^4.0.0

## Contributing

Want to improve Cedric Beta? Here's how:

1. **Fork** the repository
2. **Create** a feature branch: `git checkout -b feature/your-feature`
3. **Commit** your changes: `git commit -m 'Add: your feature'`
4. **Push** to your branch: `git push origin feature/your-feature`
5. Submit a **pull request**

## License

This project is licensed under the **Creative Commons Attribution-NonCommercial-ShareAlike (CC BY-NC-SA)** License.

- **License**: [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/)

By contributing, you agree that your contributions will be licensed under the same license.

## Contact

Have questions or found a bug?
- Open an issue on GitHub
- Or reach out to me at contact@placeholder.de
