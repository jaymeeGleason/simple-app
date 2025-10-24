import React from 'react';
import UserManagement from './components/UserManagement';
import './App.css';

function App() {
  return (
    <div className="container">
      <div className="header">
        <h1>Web Application Test</h1>
        <p>React Frontend + PHP Backend + PostgreSQL Database</p>
      </div>

      <UserManagement />
    </div>
  );
}

export default App;
