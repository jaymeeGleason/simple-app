import React from 'react';
import './App.css';

function App() {
  return (
    <div className="container">
      <div className="header">
        <h1>🚀 Web Application Test</h1>
        <p>React Frontend + PHP Backend + PostgreSQL Database</p>
      </div>

      <div className="card">
        <h2>✅ Application Status</h2>
        <p>Your full-stack web application is ready!</p>
        <ul>
          <li>✅ React frontend running on port 3000</li>
          <li>✅ PHP backend API on port 8000</li>
          <li>✅ PostgreSQL database on port 5432</li>
          <li>✅ Docker development environment</li>
        </ul>
      </div>

      <div className="card">
        <h2>🛠️ Technology Stack</h2>
        <div className="tech-grid">
          <div className="tech-item">
            <h3>Frontend</h3>
            <p>React with modern hooks</p>
          </div>
          <div className="tech-item">
            <h3>Backend</h3>
            <p>PHP with RESTful API</p>
          </div>
          <div className="tech-item">
            <h3>Database</h3>
            <p>PostgreSQL with raw SQL</p>
          </div>
          <div className="tech-item">
            <h3>DevOps</h3>
            <p>Docker & Docker Compose</p>
          </div>
        </div>
      </div>

      <div className="card">
        <h2>🎯 Ready for Interview</h2>
        <p>This application demonstrates:</p>
        <ul>
          <li>Full-stack development skills</li>
          <li>Database design and queries</li>
          <li>API development and integration</li>
          <li>Modern development practices</li>
        </ul>
      </div>
    </div>
  );
}

export default App;
