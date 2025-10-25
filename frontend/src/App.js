import React from 'react';
import './App.css';

function App() {
  return (
    <div className="container">
      <div className="header">
        <h1>BetterHelp Test</h1>
      </div>

      <div className="card">
        <h2>Technology Stack</h2>
        <div className="tech-grid">
          <div className="tech-item">
            <h3>Frontend</h3>
            <p>React (Port 3000)</p>
          </div>
          <div className="tech-item">
            <h3>Backend</h3>
            <p>PHP (Port 8000)</p>
          </div>
          <div className="tech-item">
            <h3>Database</h3>
            <p>PostgreSQL (Port 5432)</p>
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
          <ol>
            <li><code>docker compose up -d</code></li>
            <li><code>cd backend && composer install</code></li>
            <li><code>cd backend && php -S localhost:8000 -t public</code></li>
            <li><code>cd frontend && npm install</code></li>
            <li><code>cd frontend && npm start</code></li>
          </ol>
          
          <h3>Testing</h3>
          <ul>
            <li><strong>Frontend:</strong> <code>cd frontend && npm test</code></li>
            <li><strong>Backend:</strong> <code>cd backend && ./vendor/bin/phpunit</code></li>
          </ul>
          
          <p><strong>Access:</strong> <a href="http://localhost:8000/api/health" target="_blank">Backend API</a></p>
        </div>
      </div>

     
    </div>
  );
}

export default App;
