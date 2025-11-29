<div align="center">

# Autobahn - Luxury Car Dealership Platform

[![Docker](https://img.shields.io/badge/Docker-27.4-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-9.1-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.3-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128?logo=apache&logoColor=white)](https://httpd.apache.org/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

<img width="1877" alt="Autobahn Homepage" src="https://github.com/user-attachments/assets/8cc225a6-5dbc-46e0-a122-3256d3f1a254" />

</div>

A fully Dockerized web application for managing and showcasing luxury and exotic vehicles. Built with PHP 8.3, MySQL 9.1, Apache 2.4, and Bootstrap 5.3.3, Autobahn provides a complete solution for high-end automotive dealerships with one-command deployment.

## ✨ Features

### 🏎️ Vehicle Catalog

<div align="center">
<img width="1790" alt="Vehicle Catalog" src="https://github.com/user-attachments/assets/ea556fab-aa53-4132-9618-1f174aa0b598" />
</div>

- Browse luxury vehicles (Ferrari, Lamborghini, Porsche, McLaren, Bugatti, Rolls-Royce, Aston Martin, BMW, Mercedes-Benz)
- Detailed vehicle specifications modal with engine, performance, and pricing details
- Direct test drive scheduling from catalog

### 🚗 Test Drive Scheduling

<div align="center">
<img width="625" alt="Test Drive Scheduling" src="https://github.com/user-attachments/assets/5dda7545-a66c-450a-b33e-2d2a0db2fe2b" />
</div>

- Interactive form with vehicle pre-selection from catalog
- Date picker with instant calendar popup
- Success confirmation with formatted date display
- Demo mode with snackbar notifications

### 📊 Inventory Management

<div align="center">
<img width="1778" alt="Inventory Management" src="https://github.com/user-attachments/assets/6ac9507f-bf48-47c2-b09a-431813ba3f4e" />
</div>

- Real-time search and filter by brand, model, or year
- Sortable table columns (brand, model, year, price, condition, availability)
- Modal-based add/edit forms with client and server-side validation

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3 (Custom Variables), Vanilla JavaScript
- **Framework**: Bootstrap 5.3.3 (Grid, Components, Utilities)
- **Backend**: PHP 8.3 (Prepared Statements, PDO/MySQLi)
- **Web Server**: Apache 2.4 with mod_rewrite
- **Database**: MySQL 9.1
- **Containerization**: Docker 27.4 & Docker Compose 2.30
- **Design**: Custom dark theme with gold accents
- **Architecture**: MVC-inspired with separation of concerns

## Installation

### Prerequisites

- 🐋 Docker
- Git

### Quick Start with Docker

1. Clone the repository:
```bash
git clone https://github.com/MatiasCarabella/autobahn-dealership
cd autobahn-dealership
```

2. Start the application:
```bash
docker-compose up -d
```

3. Access the application at **http://localhost:8080**

The database will be automatically initialized with sample data on first run.

## Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                         Docker Host                         │
│                                                             │
│  ┌────────────────┐  ┌────────────────┐  ┌──────────────┐   │
│  │   Web (PHP)    │  │  MySQL 9.1     │  │ phpMyAdmin   │   │
│  │   Port: 8080   │  │  Port: 3306    │  │ Port: 8081   │   │
│  │                │  │                │  │              │   │
│  │  Apache 2.4    │──│  Database:     │──│  DB Manager  │   │
│  │  PHP 8.3       │  │  autobahn      │  │              │   │
│  │  mod_rewrite   │  │                │  │              │   │
│  └────────────────┘  └────────────────┘  └──────────────┘   │
│         │                     │                             │
│         └─────────────────────┴─────────────────────────────┤
│                    autobahn_network                         │
└─────────────────────────────────────────────────────────────┘
```

## Project Structure

```
autobahn/
├── database/
│   └── init.sql                 # Database schema & sample data
├── src/
│   ├── api/
│   │   └── get-vehicle.php      # Vehicle search API endpoint
│   ├── config/
│   │   └── database.php         # Database connection class (PDO/MySQLi)
│   ├── includes/
│   │   ├── header.php           # HTML head & CSS includes
│   │   ├── navbar.php           # Navigation component
│   │   └── footer.php           # Footer & JS includes
│   ├── public/
│   │   ├── css/
│   │   │   └── style.css        # Global styles (CSS variables, dark theme)
│   │   ├── js/
│   │   │   ├── inventory.js     # Inventory management logic
│   │   │   ├── catalog.js       # Catalog modal & interactions
│   │   │   └── test-drive.js    # Test drive form handling
│   │   └── images/              # Vehicle images (9 luxury cars)
│   ├── catalog.php              # Vehicle showcase with specs
│   ├── inventory.php            # CRUD operations (admin)
│   ├── test-drive.php           # Test drive scheduling form
│   ├── index.php                # Homepage with hero section
│   └── .htaccess                # Apache URL rewriting
├── docker-compose.yml           # Multi-container orchestration
├── Dockerfile                   # PHP 8.3 + Apache container
├── .dockerignore                # Docker build exclusions
└── README.md                    # Documentation
```



## License

This project is licensed under the [MIT License](LICENSE).

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
