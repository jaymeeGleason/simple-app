import React from 'react';
import './App.css';

function App() {
  return (
    <div className="container">
      <div className="header">
        <h1>BetterHelp Test</h1>
      </div>

      <div className="card">
        <h2>Ports</h2>
        <ul>
          <li>Frontend running on port 3000</li>
          <li>Backend API on port 8000</li>
          <li>Database on port 5432</li>
        </ul>
      </div>

      <div className="card">
        <h2>Technology Stack</h2>
        <div className="tech-grid">
          <div className="tech-item">
            <h3>Frontend</h3>
            <p>React</p>
          </div>
          <div className="tech-item">
            <h3>Backend</h3>
            <p>PHP</p>
          </div>
          <div className="tech-item">
            <h3>Database</h3>
            <p>PostgreSQL</p>
          </div>
          <div className="tech-item">
            <h3>DevOps</h3>
            <p>Docker & Docker Compose</p>
          </div>
        </div>
      </div>

      <div className="card">
        <h2>How to Run Locally</h2>
        <div className="instructions">
          <h3>Setup</h3>
          <ol>
            <li><strong>Start the database:</strong><br />
              <code>docker compose up -d</code></li>
            
            <li><strong>Install backend dependencies:</strong><br />
              <code>cd backend && composer install</code></li>
            
            <li><strong>Start the PHP backend:</strong><br />
              <code>cd backend && php -S localhost:8000 -t public</code></li>
            
            <li><strong>Install frontend dependencies:</strong><br />
              <code>cd frontend && npm install</code></li>
            
            <li><strong>Start the React frontend:</strong><br />
              <code>cd frontend && npm start</code></li>
          </ol>
          
          <h3>Access the Application</h3>
          <ul>
            <li>Frontend: <a href="http://localhost:3000" target="_blank" rel="noopener noreferrer">http://localhost:3000</a></li>
            <li>Backend API: <a href="http://localhost:8000/api/health" target="_blank" rel="noopener noreferrer">http://localhost:8000/api/health</a></li>
          </ul>
        </div>
      </div>

     
    </div>
  );
}

export default App;
