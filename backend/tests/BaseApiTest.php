<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Base API Test Class
 * 
 * Provides common functionality for API testing including
 * HTTP request methods that can be reused across all test classes.
 */
abstract class BaseApiTest extends TestCase
{
    /** @var string Base URL for API requests */
    protected $baseUrl = 'http://localhost:8000';

    /**
     * Helper method to make HTTP requests
     * 
     * @param string $endpoint The API endpoint to test
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param array $data Request data for POST/PUT requests
     * @return array Response data with HTTP code and JSON data
     */
    protected function makeRequest($endpoint, $method = 'GET', $data = null)
    {
        // Initialize cURL session
        $ch = curl_init();
        
        // Configure cURL options
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return response as string
        curl_setopt($ch, CURLOPT_HEADER, false);         // Don't include headers
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);           // 10 second timeout
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); // Set HTTP method
        
        // Add data for POST/PUT requests
        if ($data && in_array($method, ['POST', 'PUT'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data))
            ]);
        }
        
        // Execute request and get response
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        // Clean up cURL session
        curl_close($ch);
        
        // Return structured response data
        return [
            'http_code' => $httpCode,
            'data' => json_decode($response, true)
        ];
    }
}
