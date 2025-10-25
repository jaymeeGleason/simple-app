import React, { useState, useEffect } from 'react';
import { userService } from './services/userService';
import UserList from './components/UserList';
import UserForm from './components/UserForm';
import './App.css';

function App() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [success, setSuccess] = useState(null);
  const [editingUser, setEditingUser] = useState(null);

  // Fetch users
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

  // Handle form submission
  const handleSubmit = async (userData) => {
    try {
      setError(null);
      setSuccess(null);
      
      if (editingUser) {
        const updatedUser = await userService.update(editingUser.id, userData);
        setUsers(prev => prev.map(user => user.id === editingUser.id ? updatedUser : user));
        setSuccess('User updated successfully!');
      } else {
        const newUser = await userService.create(userData);
        setUsers(prev => [newUser, ...prev]);
        setSuccess('User created successfully!');
      }
      
      setEditingUser(null);
    } catch (err) {
      setError(err.message);
    }
  };

  // Handle delete
  const handleDelete = async (userId) => {
    if (!window.confirm('Are you sure you want to delete this user?')) {
      return;
    }

    try {
      setError(null);
      await userService.delete(userId);
      setUsers(prev => prev.filter(user => user.id !== userId));
      setSuccess('User deleted successfully!');
    } catch (err) {
      setError(err.message);
    }
  };

  // Handle edit
  const handleEdit = (user) => {
    setEditingUser(user);
    setSuccess(null);
  };

  // Cancel edit
  const handleCancel = () => {
    setEditingUser(null);
    setSuccess(null);
  };

  useEffect(() => {
    fetchUsers();
  }, []);

  return (
    <div className="container">
      <div className="header">
        <h1>Web Application Test</h1>
        <p>React Frontend + PHP Backend + PostgreSQL Database</p>
      </div>

      {error && <div className="error">{error}</div>}
      {success && <div className="success">{success}</div>}

      <div className="card">
        <h2>{editingUser ? 'Edit User' : 'Add New User'}</h2>
        <UserForm 
          user={editingUser}
          onSubmit={handleSubmit}
          onCancel={editingUser ? handleCancel : null}
        />
      </div>

      <div className="card">
        <h2>Users</h2>
        {loading ? (
          <div className="loading">Loading users...</div>
        ) : (
          <UserList 
            users={users}
            onEdit={handleEdit}
            onDelete={handleDelete}
          />
        )}
      </div>
    </div>
  );
}

export default App;
