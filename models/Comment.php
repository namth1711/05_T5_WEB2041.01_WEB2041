<?php

require_once __DIR__ . '/BaseModel.php';

class Comment extends BaseModel {
    
    
    public function insert($content, $product_id, $user_id) {
        $sql = "INSERT INTO comments (content, product_id, user_id, created_at) 
                VALUES (?, ?, ?, NOW())";
        return $this->execute($sql, [$content, $product_id, $user_id]);
    }

    
    public function getByProduct($product_id) {
        $sql = "SELECT c.*, u.fullname, u.username, u.avatar 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.product_id = ? 
                ORDER BY c.id DESC";
        return $this->getAll($sql, [$product_id]);
    }

    
    public function all() {
        $sql = "SELECT c.*, u.fullname as user_fullname, p.name as product_name 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                JOIN products p ON c.product_id = p.id 
                ORDER BY c.id DESC";
        return $this->getAll($sql);
    }

    
    public function getStatsByProduct() {
        $sql = "SELECT p.id, p.name as product_name, 
                       COUNT(c.id) as total_comments, 
                       MIN(c.created_at) as oldest_comment, 
                       MAX(c.created_at) as conversion_latest 
                FROM products p 
                JOIN comments c ON p.id = c.product_id 
                GROUP BY p.id, p.name 
                ORDER BY total_comments DESC";
        return $this->getAll($sql);
    }

    
    public function delete(int $id) {
        $sql = "DELETE FROM comments WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}

