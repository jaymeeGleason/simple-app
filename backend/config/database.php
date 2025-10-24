<?php

return [
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'port' => $_ENV['DB_PORT'] ?? '5432',
    'database' => $_ENV['DB_NAME'] ?? 'webapp_test',
    'username' => $_ENV['DB_USER'] ?? 'webapp_user',
    'password' => $_ENV['DB_PASSWORD'] ?? 'webapp_password',
];
