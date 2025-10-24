import React, { useState } from 'react';
import { useUsers } from '../hooks/useUsers';
import UserList from './UserList';
import UserForm from './UserForm';

function UserManagement() {
  const { users, loading, error, createUser, updateUser, deleteUser } = useUsers();
  const [editingUser, setEditingUser] = useState(null);
  const [success, setSuccess] = useState(null);

  // Handle user form submission (create or update)
  const handleUserSubmit = async (userData) => {
    setSuccess(null);
    
    const result = editingUser 
      ? await updateUser(editingUser.id, userData)
      : await createUser(userData);
    
    if (result.success) {
      setSuccess(result.message);
      setEditingUser(null);
    }
  };

  // Handle user deletion
  const handleDeleteUser = async (userId) => {
    if (!window.confirm('Are you sure you want to delete this user?')) {
      return;
    }

    const result = await deleteUser(userId);
    if (result.success) {
      setSuccess(result.message);
    }
  };

  // Handle user editing
  const handleEditUser = (user) => {
    setEditingUser(user);
    setSuccess(null);
  };

  // Cancel editing
  const handleCancelEdit = () => {
    setEditingUser(null);
    setSuccess(null);
  };

  return (
    <>
      <div className="card">
        <h2>{editingUser ? 'Edit User' : 'Add New User'}</h2>
        <UserForm 
          user={editingUser}
          onSubmit={handleUserSubmit}
          onCancel={editingUser ? handleCancelEdit : null}
        />
      </div>

      <div className="card">
        <h2>Users</h2>
        {loading ? (
          <div className="loading">Loading users...</div>
        ) : (
          <UserList 
            users={users}
            onEdit={handleEditUser}
            onDelete={handleDeleteUser}
          />
        )}
      </div>

      {error && (
        <div className="error">
          {error}
        </div>
      )}

      {success && (
        <div className="success">
          {success}
        </div>
      )}
    </>
  );
}

export default UserManagement;
