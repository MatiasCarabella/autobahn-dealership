# Autobahn - Luxury Car Dealership Platform

[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-9.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.3-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A premium, fully Dockerized web application for managing and showcasing luxury and exotic vehicles. Built with PHP 8.3, MySQL 9.0, and Bootstrap 5.3, Autobahn provides a complete solution for high-end automotive dealerships with one-command deployment.

## Features

- **Vehicle Catalog** - Browse a curated collection of luxury vehicles including Ferrari, Lamborghini, Porsche, McLaren, Bugatti, and more
- **Inventory Management** - Full CRUD operations for managing vehicle inventory with real-time updates
- **Test Drive Scheduling** - Easy-to-use interface for customers to schedule test drives
- **Vehicle Search** - AJAX-powered search functionality to query vehicles by ID
- **User Authentication** - Multi-step registration process and secure login system
- **Responsive Design** - Mobile-friendly interface with elegant dark theme and gold accents

## Tech Stack

- **Frontend**: HTML5, CSS3, Bootstrap 5.3.3, jQuery 3.7.1
- **Backend**: PHP 8.3
- **Database**: MySQL 9.0
- **Containerization**: Docker & Docker Compose
- **Design**: Custom dark theme with gold accent colors

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
2. Set up a PHP 8.2+ environment with MySQL 8.0+
3. Import `database/init.sql` into your MySQL database
4. Configure database credentials in `src/config/database.php`
5. Point your web server to the `src/` directory

## Docker Services

The application includes three Docker services:

- **web**: PHP 8.2 with Apache (port 8080)
- **db**: MySQL 8.0 (port 3306)
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
│   └── init.sql                 # Database initialization script
├── src/
│   ├── api/
│   │   └── get-vehicle.php      # Vehicle search API endpoint
│   ├── config/
│   │   └── database.php         # Database configuration class
│   ├── includes/
│   │   ├── header.php           # Common header template
│   │   ├── navbar.php           # Navigation bar component
│   │   └── footer.php           # Common footer template
│   ├── public/
│   │   ├── css/
│   │   │   └── style.css        # Global styles
│   │   ├── js/                  # JavaScript files
│   │   └── images/              # Vehicle images
│   ├── catalog.php              # Vehicle catalog page
│   ├── inventory.php            # Inventory management (CRUD)
│   ├── search.php               # Vehicle search interface
│   ├── test-drive.php           # Test drive scheduling
│   ├── index.php                # Entry point (redirects to catalog)
│   └── .htaccess                # Apache configuration
├── docker-compose.yml           # Docker services configuration
├── Dockerfile                   # Web container definition
└── README.md                    # This file
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
│  │   Web (PHP)    │  │  MySQL 8.0     │  │ phpMyAdmin   │  │
│  │   Port: 8080   │  │  Port: 3306    │  │ Port: 8081   │  │
│  │                │  │                │  │              │  │
│  │  Apache 2.4    │──│  Database:     │──│  DB Manager  │  │
│  │  PHP 8.2       │  │  autobahn      │  │              │  │
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

## Color Scheme

- Background: `#2C2C2C` (Dark Gray)
- Cards: `#1F1F1F` (Darker Gray)
- Primary Accent: `#CBA135` (Gold)
- Hover Accent: `#FFD700` (Bright Gold)
- Text: `#F5F5F5` (Off-White)

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

## Security Notes

⚠️ **Important**: This is a demonstration project. For production use:
- ✅ Prepared statements implemented for API endpoints
- ✅ Environment variables for database credentials
- ✅ Input validation and sanitization
- ⚠️ Add password hashing for user authentication
- ⚠️ Implement CSRF protection
- ⚠️ Implement proper session management
- ⚠️ Add SSL/TLS encryption
- ⚠️ Use stronger database passwords
- ⚠️ Implement rate limiting for API endpoints

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

## Roadmap

- [ ] User authentication system
- [ ] Shopping cart functionality
- [ ] Payment gateway integration
- [ ] Email notifications for test drives
- [ ] Advanced search filters
- [ ] Vehicle comparison feature
- [ ] Admin dashboard
- [ ] Multi-language support
