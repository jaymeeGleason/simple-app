# Web Application Test Project

A simple web application built with React frontend, PHP backend, and PostgreSQL database.

## Project Structure

```
starter_proj/
├── frontend/          # React application
├── backend/           # PHP API server
├── database/          # Database schema and migrations
├── docker-compose.yml # Development environment
└── README.md         # This file
```

## Prerequisites

- Node.js (v16 or higher)
- PHP (v8.0 or higher)
- PostgreSQL (v12 or higher)
- Composer (for PHP dependencies)

## Quick Start

1. **Start the database:**
   ```bash
   docker-compose up -d postgres
   ```

2. **Set up the backend:**
   ```bash
   cd backend
   composer install
   php -S localhost:8000
   ```

3. **Set up the frontend:**
   ```bash
   cd frontend
   npm install
   npm start
   ```

4. **Access the application:**
   - Frontend: http://localhost:3000
   - Backend API: http://localhost:8000

## Database Setup

The application uses PostgreSQL with a simple users table. The database configuration is in `backend/config/database.php`.

## API Endpoints

- `GET /api/users` - Get all users
- `POST /api/users` - Create a new user
- `GET /api/users/{id}` - Get user by ID
- `PUT /api/users/{id}` - Update user
- `DELETE /api/users/{id}` - Delete user

## Development Notes

- No ORMs used - all database queries are raw SQL
- CORS enabled for frontend-backend communication
- Basic error handling and validation included
