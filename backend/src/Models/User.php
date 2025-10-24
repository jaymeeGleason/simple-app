<?php

namespace App\Models;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = \App\Database::getInstance();
    }

    public function getAll()
    {
        $sql = "SELECT id, name, email, created_at, updated_at FROM users ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT id, name, email, created_at, updated_at FROM users WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email) RETURNING id, name, email, created_at, updated_at";
        $stmt = $this->db->query($sql, [
            'name' => $data['name'],
            'email' => $data['email']
        ]);
        return $stmt->fetch();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE users SET name = :name, email = :email, updated_at = CURRENT_TIMESTAMP WHERE id = :id RETURNING id, name, email, created_at, updated_at";
        $stmt = $this->db->query($sql, [
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email']
        ]);
        return $stmt->fetch();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
