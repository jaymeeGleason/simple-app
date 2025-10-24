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
        try {
            $users = $this->user->getAll();
            \App\ApiResponse::success($users, 'Users retrieved successfully');
        } catch (\Exception $e) {
            \App\ApiResponse::error('Failed to retrieve users', 500, $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            $userData = $this->user->getById($id);
            
            if (!$userData) {
                \App\ApiResponse::error('User not found', 404);
            }
            
            \App\ApiResponse::success($userData, 'User retrieved successfully');
        } catch (\Exception $e) {
            \App\ApiResponse::error('Failed to retrieve user', 500, $e->getMessage());
        }
    }

    public function create($input)
    {
        try {
            // Validation
            if (!isset($input['name']) || !isset($input['email'])) {
                \App\ApiResponse::error('Name and email are required', 400);
            }

            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                \App\ApiResponse::error('Invalid email format', 400);
            }

            $newUser = $this->user->create($input);
            \App\ApiResponse::success($newUser, 'User created successfully', 201);
        } catch (\Exception $e) {
            \App\ApiResponse::error('Failed to create user', 500, $e->getMessage());
        }
    }

    public function update($id, $input)
    {
        try {
            // Validation
            if (!isset($input['name']) || !isset($input['email'])) {
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
        } catch (\Exception $e) {
            \App\ApiResponse::error('Failed to update user', 500, $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $deleted = $this->user->delete($id);
            
            if (!$deleted) {
                \App\ApiResponse::error('User not found', 404);
            }
            
            \App\ApiResponse::success(null, 'User deleted successfully');
        } catch (\Exception $e) {
            \App\ApiResponse::error('Failed to delete user', 500, $e->getMessage());
        }
    }
}
