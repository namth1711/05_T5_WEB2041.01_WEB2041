<?php

require_once __DIR__ . '/BaseModel.php';

class Product extends BaseModel {
    
    public function all() {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";
        return $this->getAll($sql);
    }

    public function getLatest($limit = 6) {
        $limit = intval($limit);
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC 
                LIMIT $limit";
        return $this->getAll($sql);
    }

    public function getFeatured($limit = 6) {
        $limit = intval($limit);
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.views DESC 
                LIMIT $limit";
        return $this->getAll($sql);
    }

    public function allByCategory($categoryId) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.category_id = ? 
                ORDER BY p.id DESC";
        return $this->getAll($sql, [$categoryId]);
    }

    public function search($query) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE ? OR p.description LIKE ? 
                ORDER BY p.id DESC";
        $searchTerm = "%$query%";
        return $this->getAll($sql, [$searchTerm, $searchTerm]);
    }

    public function find(int $id) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ?";
        return $this->getOne($sql, [$id]);
    }

    public function insert($name, $price, $image, $description, $category_id) {
        $sql = "INSERT INTO products (name, price, image, description, category_id, views) 
                VALUES (?, ?, ?, ?, ?, 0)";
        return $this->execute($sql, [$name, $price, $image, $description, $category_id]);
    }

    public function update(int $id, $name, $price, $image, $description, $category_id) {
        if ($image != null) {
            $sql = "UPDATE products SET name = ?, price = ?, image = ?, description = ?, category_id = ? 
                    WHERE id = ?";
            return $this->execute($sql, [$name, $price, $image, $description, $category_id, $id]);
        } else {
            $sql = "UPDATE products SET name = ?, price = ?, description = ?, category_id = ? 
                    WHERE id = ?";
            return $this->execute($sql, [$name, $price, $description, $category_id, $id]);
        }
    }

    public function incrementViews(int $id) {
        $sql = "UPDATE products SET views = views + 1 WHERE id = ?";
        return $this->execute($sql, [$id]);
    }

    public function delete(int $id) {
        $sql = "DELETE FROM products WHERE id = ?";
        return $this->execute($sql, [$id]);
    }

    public function getStats() {
        $sql = "SELECT c.id, c.name, 
                       COUNT(p.id) as total_products, 
                       MIN(p.price) as min_price, 
                       MAX(p.price) as max_price, 
                       AVG(p.price) as avg_price 
                FROM categories c 
                LEFT JOIN products p ON c.id = p.category_id 
                GROUP BY c.id, c.name";
        return $this->getAll($sql);
    }
}
