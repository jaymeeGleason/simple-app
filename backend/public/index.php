<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\ApiResponse;

// Handle CORS preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    http_response_code(200);
    exit;
}

// Simple routing
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$path = parse_url($requestUri, PHP_URL_PATH);
$path = rtrim($path, '/');

try {
    // Route: GET /api/health
    if ($path === '/api/health' && $requestMethod === 'GET') {
        ApiResponse::success([
            'status' => 'ok', 
            'timestamp' => date('Y-m-d H:i:s'),
            'message' => 'Simple web application is running!'
        ], 'API is healthy');
    }

    // Route: GET /api/info
    if ($path === '/api/info' && $requestMethod === 'GET') {
        ApiResponse::success([
            'name' => 'Web Application Test',
            'version' => '1.0.0',
            'description' => 'Simple full-stack web application',
            'tech_stack' => [
                'Frontend' => 'React',
                'Backend' => 'PHP',
                'Database' => 'PostgreSQL',
                'DevOps' => 'Docker'
            ]
        ], 'Application information');
    }

    // 404 for unmatched routes
    ApiResponse::error('Endpoint not found', 404);

} catch (Exception $e) {
    ApiResponse::error('Internal server error', 500, $e->getMessage());
}
