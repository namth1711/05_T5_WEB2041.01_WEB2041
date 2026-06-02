<?php

require_once __DIR__ . '/BaseModel.php';

class Category extends BaseModel {
    
    
    public function all() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return $this->getAll($sql);
    }

    
    public function allWithCount() {
        $sql = "SELECT c.*, COUNT(p.id) as product_count 
                FROM categories c 
                LEFT JOIN products p ON c.id = p.category_id 
                GROUP BY c.id 
                ORDER BY c.id DESC";
        return $this->getAll($sql);
    }

    
    public function find(int $id) {
        $sql = "SELECT * FROM categories WHERE id = ?";
        return $this->getOne($sql, [$id]);
    }

    
    public function insert($name, $description = '') {
        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        return $this->execute($sql, [$name, $description]);
    }

    
    public function update(int $id, $name, $description = '') {
        $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        return $this->execute($sql, [$name, $description, $id]);
    }

    
    public function delete(int $id) {
        $sql = "DELETE FROM categories WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}

