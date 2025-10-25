<?php

namespace App\Controllers;

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new \App\Models\User();
    }

    public function getAll()
    {
        $users = $this->user->getAll();
        \App\ApiResponse::success($users, 'Users retrieved successfully');
    }

    public function getById($id)
    {
        $userData = $this->user->getById($id);
        
        if (!$userData) {
            \App\ApiResponse::error('User not found', 404);
        }
        
        \App\ApiResponse::success($userData, 'User retrieved successfully');
    }

    public function create($input)
    {
        // Simple validation
        if (empty($input['name']) || empty($input['email'])) {
            \App\ApiResponse::error('Name and email are required', 400);
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            \App\ApiResponse::error('Invalid email format', 400);
        }

        $newUser = $this->user->create($input);
        \App\ApiResponse::success($newUser, 'User created successfully', 201);
    }

    public function update($id, $input)
    {
        // Simple validation
        if (empty($input['name']) || empty($input['email'])) {
            \App\ApiResponse::error('Name and email are required', 400);
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            \App\ApiResponse::error('Invalid email format', 400);
        }

        $updatedUser = $this->user->update($id, $input);
        
        if (!$updatedUser) {
            \App\ApiResponse::error('User not found', 404);
        }
        
        \App\ApiResponse::success($updatedUser, 'User updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->user->delete($id);
        
        if (!$deleted) {
            \App\ApiResponse::error('User not found', 404);
        }
        
        \App\ApiResponse::success(null, 'User deleted successfully');
    }
}
