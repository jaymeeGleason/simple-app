<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Load Composer dependencies

use App\Database;
use App\Models\User;
use App\Controllers\UserController;
use App\ApiResponse;

// Handle CORS preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    http_response_code(200);
    exit;
}

// Simple routing
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove query string and trailing slash
$path = parse_url($requestUri, PHP_URL_PATH);
$path = rtrim($path, '/');

try {
    $userController = new UserController();

    // Route: GET /api/users
    if ($path === '/api/users' && $requestMethod === 'GET') {
        $userController->getAll();
    }

    // Route: POST /api/users
    if ($path === '/api/users' && $requestMethod === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $userController->create($input);
    }

    // Route: GET /api/users/{id}
    if (preg_match('/^\/api\/users\/(\d+)$/', $path, $matches) && $requestMethod === 'GET') {
        $userId = (int)$matches[1];
        $userController->getById($userId);
    }

    // Route: PUT /api/users/{id}
    if (preg_match('/^\/api\/users\/(\d+)$/', $path, $matches) && $requestMethod === 'PUT') {
        $userId = (int)$matches[1];
        $input = json_decode(file_get_contents('php://input'), true);
        $userController->update($userId, $input);
    }

    // Route: DELETE /api/users/{id}
    if (preg_match('/^\/api\/users\/(\d+)$/', $path, $matches) && $requestMethod === 'DELETE') {
        $userId = (int)$matches[1];
        $userController->delete($userId);
    }

    // Route: GET /api/health
    if ($path === '/api/health' && $requestMethod === 'GET') {
        ApiResponse::success(['status' => 'ok', 'timestamp' => date('Y-m-d H:i:s')], 'API is healthy');
    }

    // 404 for unmatched routes
    ApiResponse::error('Endpoint not found', 404);

} catch (Exception $e) {
    ApiResponse::error('Internal server error', 500, $e->getMessage());
}
