import { useState, useEffect } from 'react';
import { userService } from '../services/userService';

export const useUsers = () => {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Fetch users from API
  const fetchUsers = async () => {
    try {
      setLoading(true);
      setError(null);
      const usersData = await userService.getAll();
      setUsers(usersData);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  // Create user
  const createUser = async (userData) => {
    try {
      setError(null);
      const newUser = await userService.create(userData);
      setUsers(prev => [newUser, ...prev]); // Add to beginning of list
      return { success: true, message: 'User created successfully!' };
    } catch (err) {
      setError(err.message);
      return { success: false, message: err.message };
    }
  };

  // Update user
  const updateUser = async (id, userData) => {
    try {
      setError(null);
      const updatedUser = await userService.update(id, userData);
      setUsers(prev => prev.map(user => 
        user.id === id ? updatedUser : user
      ));
      return { success: true, message: 'User updated successfully!' };
    } catch (err) {
      setError(err.message);
      return { success: false, message: err.message };
    }
  };

  // Delete user
  const deleteUser = async (id) => {
    try {
      setError(null);
      await userService.delete(id);
      setUsers(prev => prev.filter(user => user.id !== id));
      return { success: true, message: 'User deleted successfully!' };
    } catch (err) {
      setError(err.message);
      return { success: false, message: err.message };
    }
  };

  // Load users on mount
  useEffect(() => {
    fetchUsers();
  }, []);

  return {
    users,
    loading,
    error,
    createUser,
    updateUser,
    deleteUser,
    refetch: fetchUsers
  };
};
