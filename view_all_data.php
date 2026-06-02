<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    require_once __DIR__ . '/configs/env.php';
    
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
    
    echo "\n" . str_repeat("=", 150) . "\n";
    echo "DATABASE: " . DB_NAME . "\n";
    echo str_repeat("=", 150) . "\n\n";
    
    // 1. USERS
    echo "📋 BẢNG USERS\n";
    echo str_repeat("-", 150) . "\n";
    $sql = "SELECT id, username, email, fullname, role, status FROM users ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    
    printf("%-5s | %-20s | %-30s | %-25s | %-5s | %-10s\n", "ID", "Username", "Email", "Fullname", "Role", "Status");
    echo str_repeat("-", 150) . "\n";
    foreach ($users as $user) {
        $role = $user['role'] == 0 ? 'Client' : 'Admin';
        $status = $user['status'] == 1 ? 'Active' : 'Inactive';
        printf("%-5s | %-20s | %-30s | %-25s | %-5s | %-10s\n",
            $user['id'], $user['username'], $user['email'], 
            substr($user['fullname'], 0, 25), $role, $status);
    }
    echo "Tổng: " . count($users) . " user(s)\n\n";
    
    // 2. CATEGORIES
    echo "📋 BẢNG CATEGORIES\n";
    echo str_repeat("-", 150) . "\n";
    $sql = "SELECT id, name, description FROM categories ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    
    printf("%-5s | %-40s | %-100s\n", "ID", "Name", "Description");
    echo str_repeat("-", 150) . "\n";
    foreach ($categories as $cat) {
        printf("%-5s | %-40s | %-100s\n",
            $cat['id'], substr($cat['name'], 0, 40), substr($cat['description'], 0, 100));
    }
    echo "Tổng: " . count($categories) . " category(ies)\n\n";
    
    // 3. PRODUCTS
    echo "📋 BẢNG PRODUCTS\n";
    echo str_repeat("-", 150) . "\n";
    $sql = "SELECT id, name, price, category_id, views FROM products ORDER BY id DESC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();
    
    printf("%-5s | %-40s | %-15s | %-12s | %-10s\n", "ID", "Name", "Price", "Category ID", "Views");
    echo str_repeat("-", 150) . "\n";
    foreach ($products as $prod) {
        printf("%-5s | %-40s | %-15s | %-12s | %-10s\n",
            $prod['id'], substr($prod['name'], 0, 40), number_format($prod['price'], 0, '.', ',') . ' VND', 
            $prod['category_id'], $prod['views']);
    }
    $countProducts = $conn->query("SELECT COUNT(*) as total FROM products")->fetch()['total'];
    echo "Tổng: " . $countProducts . " product(s) (hiển thị 10)\n\n";
    
    // 4. COMMENTS
    echo "📋 BẢNG COMMENTS\n";
    echo str_repeat("-", 150) . "\n";
    try {
        $sql = "SELECT id, user_id, product_id, content, created_at FROM comments ORDER BY id DESC LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        
        printf("%-5s | %-8s | %-10s | %-80s | %-20s\n", "ID", "User ID", "Product ID", "Content", "Created At");
        echo str_repeat("-", 150) . "\n";
        foreach ($comments as $comment) {
            printf("%-5s | %-8s | %-10s | %-80s | %-20s\n",
                $comment['id'], $comment['user_id'], $comment['product_id'], 
                substr($comment['content'], 0, 80), $comment['created_at']);
        }
        $countComments = $conn->query("SELECT COUNT(*) as total FROM comments")->fetch()['total'];
        echo "Tổng: " . $countComments . " comment(s) (hiển thị 5)\n\n";
    } catch (Exception $e) {
        echo "Không có dữ liệu comments hoặc bảng chưa được tạo\n\n";
    }
    
    echo str_repeat("=", 150) . "\n\n";
    
} catch (Exception $e) {
    echo "❌ LỖI: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " (Line: " . $e->getLine() . ")\n";
}
