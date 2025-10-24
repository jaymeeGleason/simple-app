#!/bin/bash

echo "🧪 Testing API Endpoints"
echo "======================="

BASE_URL="http://localhost:8000"

# Test health endpoint
echo "1. Testing health endpoint..."
curl -s "$BASE_URL/api/health" | jq '.' 2>/dev/null || echo "Health endpoint response received"

echo ""

# Test get all users
echo "2. Testing GET /api/users..."
curl -s "$BASE_URL/api/users" | jq '.' 2>/dev/null || echo "Users endpoint response received"

echo ""

# Test create user
echo "3. Testing POST /api/users..."
curl -s -X POST "$BASE_URL/api/users" \
  -H "Content-Type: application/json" \
  -d '{"name":"Test User","email":"test@example.com"}' | jq '.' 2>/dev/null || echo "Create user response received"

echo ""

# Test get specific user (assuming user with ID 1 exists)
echo "4. Testing GET /api/users/1..."
curl -s "$BASE_URL/api/users/1" | jq '.' 2>/dev/null || echo "Get user response received"

echo ""

echo "✅ API testing complete!"
echo ""
echo "If you see JSON responses above, your API is working correctly."
echo "If you see error messages, make sure:"
echo "1. The backend server is running (php -S localhost:8000)"
echo "2. The database is running (docker-compose up -d postgres)"
echo "3. All dependencies are installed"
