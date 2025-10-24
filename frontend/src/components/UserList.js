import React from 'react';

function UserList({ users, onEdit, onDelete }) {
  if (users.length === 0) {
    return (
      <div className="loading">
        No users found. Create your first user above!
      </div>
    );
  }

  return (
    <div className="user-list">
      {users.map(user => (
        <div key={user.id} className="user-item">
          <h3>{user.name}</h3>
          <p><strong>Email:</strong> {user.email}</p>
          <p><strong>ID:</strong> {user.id}</p>
          <p><strong>Created:</strong> {new Date(user.created_at).toLocaleDateString()}</p>
          {user.updated_at !== user.created_at && (
            <p><strong>Updated:</strong> {new Date(user.updated_at).toLocaleDateString()}</p>
          )}
          
          <div className="user-actions">
            <button 
              className="btn btn-secondary"
              onClick={() => onEdit(user)}
            >
              Edit
            </button>
            <button 
              className="btn btn-danger"
              onClick={() => onDelete(user.id)}
            >
              Delete
            </button>
          </div>
        </div>
      ))}
    </div>
  );
}

export default UserList;
