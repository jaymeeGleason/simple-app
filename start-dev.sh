#!/bin/bash

echo "🚀 Starting Web Application Development Environment"
echo "=========================================="

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker first."
    exit 1
fi

# Start PostgreSQL database
echo "📦 Starting PostgreSQL database..."
docker-compose up -d postgres

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 5

# Check if database is accessible
echo "🔍 Testing database connection..."
docker-compose exec postgres psql -U webapp_user -d webapp_test -c "SELECT 1;" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ Database is ready!"
else
    echo "❌ Database connection failed. Please check Docker setup."
    exit 1
fi

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
cd backend
if [ ! -d "vendor" ]; then
    composer install
fi
cd ..

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
cd frontend
if [ ! -d "node_modules" ]; then
    npm install
fi
cd ..

echo ""
echo "🎉 Setup complete! You can now start the servers:"
echo ""
echo "Backend (PHP):"
echo "  cd backend && php -S localhost:8000"
echo ""
echo "Frontend (React):"
echo "  cd frontend && npm start"
echo ""
echo "Access your application at:"
echo "  Frontend: http://localhost:3000"
echo "  Backend API: http://localhost:8000"
echo ""
echo "Database:"
echo "  Host: localhost:5432"
echo "  Database: webapp_test"
echo "  User: webapp_user"
echo "  Password: webapp_password"
