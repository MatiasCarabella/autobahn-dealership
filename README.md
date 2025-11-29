# Autobahn - Luxury Car Dealership Platform

[![Docker](https://img.shields.io/badge/Docker-27.4-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-9.1-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.3-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128?logo=apache&logoColor=white)](https://httpd.apache.org/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A premium, fully Dockerized web application for managing and showcasing luxury and exotic vehicles. Built with PHP 8.3, MySQL 9.1, Apache 2.4, and Bootstrap 5.3.3, Autobahn provides a complete solution for high-end automotive dealerships with one-command deployment.

## ✨ Features

### 🏎️ Vehicle Catalog
- Browse 9 curated luxury vehicles (Ferrari, Lamborghini, Porsche, McLaren, Bugatti, Rolls-Royce, Aston Martin, BMW, Mercedes-Benz)
- Detailed vehicle specifications modal with engine, performance, and pricing details
- Exclusive purchase benefits for each vehicle
- Direct test drive scheduling from catalog

### 📊 Inventory Management
- Full CRUD operations with prepared statements (SQL injection protected)
- Real-time search and filter by brand, model, or year
- Sortable table columns (brand, model, year, price, condition, availability)
- Modal-based add/edit forms with client and server-side validation
- Inline delete with confirmation
- Toast notifications for all operations

### 🚗 Test Drive Scheduling
- Interactive form with vehicle pre-selection from catalog
- Date picker with instant calendar popup
- Success confirmation with formatted date display
- Demo mode with snackbar notifications

### 🎨 Premium UI/UX
- Dark theme with gold accents (#D4AF37)
- Smooth animations and transitions
- Responsive design (mobile, tablet, desktop)
- Hover effects and micro-interactions
- Premium table styling with gradient headers
- Snackbar notifications (auto-dismiss)

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

- Docker Desktop (or Docker Engine + Docker Compose)
- Git

### Quick Start with Docker

1. Clone the repository:
```bash
git clone <repository-url>
cd autobahn
```

2. Start the application:
```bash
docker-compose up -d
```

3. Access the application:
   - **Main Application**: http://localhost:8080
   - **phpMyAdmin**: http://localhost:8081

The database will be automatically initialized with sample data on first run.

### Manual Setup (Without Docker)

1. Clone the repository
2. Set up a PHP 8.3+ environment with MySQL 9.0+
3. Import `database/init.sql` into your MySQL database
4. Configure database credentials in `src/config/database.php`
5. Point your web server to the `src/` directory

## Docker Services

The application includes three Docker services:

- **web**: PHP 8.3 with Apache 2.4 (port 8080)
- **db**: MySQL 9.1 (port 3306)
- **phpmyadmin**: Database management interface (port 8081)

### Docker Commands

```bash
# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs -f

# Rebuild containers
docker-compose up -d --build

# Restart services
docker-compose restart

# Access MySQL CLI
docker exec -it autobahn_db mysql -u autobahn_user -pautobahn_pass

# Backup database
docker exec autobahn_db mysqldump -u autobahn_user -pautobahn_pass autobahn > backup.sql

# Restore database
docker exec -i autobahn_db mysql -u autobahn_user -pautobahn_pass autobahn < backup.sql
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

## Usage

### Viewing the Catalog
Navigate to http://localhost:8080/catalog to browse available luxury vehicles with exclusive purchase benefits.

### Managing Inventory
Access http://localhost:8080/inventory to:
- Add new vehicles to inventory
- Edit existing vehicle details
- Delete vehicles from inventory
- View all vehicles in a sortable table

### Scheduling Test Drives
Use http://localhost:8080/test-drive to select a vehicle model and preferred date for a test drive.

### Searching Vehicles
The http://localhost:8080/search page allows searching for specific vehicles by ID using AJAX requests.

### Database Management
Access phpMyAdmin at http://localhost:8081 to manage the database directly:
- Username: `autobahn_user`
- Password: `autobahn_pass`

## Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                         Docker Host                          │
│                                                              │
│  ┌────────────────┐  ┌────────────────┐  ┌──────────────┐  │
│  │   Web (PHP)    │  │  MySQL 9.1     │  │ phpMyAdmin   │  │
│  │   Port: 8080   │  │  Port: 3306    │  │ Port: 8081   │  │
│  │                │  │                │  │              │  │
│  │  Apache 2.4    │──│  Database:     │──│  DB Manager  │  │
│  │  PHP 8.3       │  │  autobahn      │  │              │  │
│  │  mod_rewrite   │  │                │  │              │  │
│  └────────────────┘  └────────────────┘  └──────────────┘  │
│         │                     │                             │
│         └─────────────────────┴─────────────────────────────┤
│                    autobahn_network                         │
└─────────────────────────────────────────────────────────────┘
```

### Application Structure

```
src/
├── config/              # Configuration layer
│   └── database.php     # DB connection abstraction
├── includes/            # View components
│   ├── header.php       # HTML head + opening tags
│   ├── navbar.php       # Navigation component
│   └── footer.php       # Closing tags + scripts
├── api/                 # API layer (RESTful)
│   └── get-vehicle.php  # Vehicle search endpoint
├── public/              # Static assets
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript
│   └── images/         # Vehicle images
└── *.php               # Page controllers
```

### Design Patterns
- **MVC-inspired structure**: Separation of concerns with includes, config, and public directories
- **Database abstraction**: Centralized database configuration with PDO and MySQLi support
- **Component-based UI**: Reusable header, navbar, and footer components
- **RESTful API**: Clean API endpoints for data retrieval
- **Environment-based config**: Docker-friendly configuration management

### Features in Detail

#### Catalog
- Showcases 9 premium vehicle models
- Each vehicle includes exclusive perks (track experiences, factory tours, VIP access)
- Responsive card-based layout

#### Inventory Management
- Real-time CRUD operations with prepared statements
- Form validation
- Success/error notifications
- Toggle-able add/edit form
- Inline delete functionality with confirmation

#### API
- RESTful endpoint for vehicle data retrieval
- JSON response format
- Input validation and sanitization
- Comprehensive error handling

#### Database
- Normalized schema with proper relationships
- Auto-initialization with sample data
- UTF-8 support for international characters
- Timestamps for audit trails



## Configuration

All configuration is managed in `docker-compose.yml`. To change database credentials or other settings, edit the environment variables in that file:

```yaml
environment:
  - DB_HOST=db
  - DB_PORT=3306
  - DB_NAME=autobahn
  - DB_USER=autobahn_user
  - DB_PASSWORD=autobahn_pass
```



## License

This project is licensed under the MIT License - see the LICENSE file for details.



## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

### Development Setup
1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Make your changes in the `src/` directory
4. Test with Docker: `docker-compose up -d`
5. Commit your changes: `git commit -am 'Add feature'`
6. Push to the branch: `git push origin feature-name`
7. Submit a Pull Request

## Support

For issues or questions, please open an issue in the repository.


