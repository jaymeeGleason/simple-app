<?php

namespace App;

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getAll()
    {
        try {
            $users = $this->user->getAll();
            ApiResponse::success($users, 'Users retrieved successfully');
        } catch (\Exception $e) {
            ApiResponse::error('Failed to retrieve users', 500, $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            $userData = $this->user->getById($id);
            
            if (!$userData) {
                ApiResponse::error('User not found', 404);
            }
            
            ApiResponse::success($userData, 'User retrieved successfully');
        } catch (\Exception $e) {
            ApiResponse::error('Failed to retrieve user', 500, $e->getMessage());
        }
    }

    public function create($input)
    {
        try {
            // Validation
            if (!isset($input['name']) || !isset($input['email'])) {
                ApiResponse::error('Name and email are required', 400);
            }

            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                ApiResponse::error('Invalid email format', 400);
            }

            $newUser = $this->user->create($input);
            ApiResponse::success($newUser, 'User created successfully', 201);
        } catch (\Exception $e) {
            ApiResponse::error('Failed to create user', 500, $e->getMessage());
        }
    }

    public function update($id, $input)
    {
        try {
            // Validation
            if (!isset($input['name']) || !isset($input['email'])) {
                ApiResponse::error('Name and email are required', 400);
            }

            if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
                ApiResponse::error('Invalid email format', 400);
            }

            $updatedUser = $this->user->update($id, $input);
            
            if (!$updatedUser) {
                ApiResponse::error('User not found', 404);
            }
            
            ApiResponse::success($updatedUser, 'User updated successfully');
        } catch (\Exception $e) {
            ApiResponse::error('Failed to update user', 500, $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $deleted = $this->user->delete($id);
            
            if (!$deleted) {
                ApiResponse::error('User not found', 404);
            }
            
            ApiResponse::success(null, 'User deleted successfully');
        } catch (\Exception $e) {
            ApiResponse::error('Failed to delete user', 500, $e->getMessage());
        }
    }
}
