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

     
    </div>
  );
}

export default App;
