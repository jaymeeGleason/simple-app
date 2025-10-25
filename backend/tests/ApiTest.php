<?php

namespace Tests;

/**
 * API Test Suite
 * 
 * Tests the backend API endpoints to ensure they return
 * correct responses and data structures.
 */
class ApiTest extends BaseApiTest
{
    /**
     * Test the health endpoint
     */
    public function testHealthEndpoint()
    {
        $response = $this->makeRequest('/api/health');
        $this->assertEquals(200, $response['http_code']);
        $this->assertTrue($response['data']['success']);
    }

    /**
     * Test the info endpoint
     */
    public function testInfoEndpoint()
    {
        $response = $this->makeRequest('/api/info');
        $this->assertEquals(200, $response['http_code']);
        $this->assertArrayHasKey('success', $response['data']);
    }

}
