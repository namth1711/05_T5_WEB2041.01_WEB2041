<?php

require_once __DIR__ . '/BaseModel.php';

class User extends BaseModel {
    
    
    public function all() {
        $sql = "SELECT id, username, email, fullname, role, avatar, status FROM users ORDER BY id DESC";
        return $this->getAll($sql);
    }

    
    public function find(int $id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->getOne($sql, [$id]);
    }

    
    public function login(string $username, string $password) {
        $sql = "SELECT * FROM users WHERE username = ? AND status = 1";
        $user = $this->getOne($sql, [$username]);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    
    public function register(string $username, string $password, string $email, $fullname = '', $avatar = 'assets/uploads/default-avatar.png') {
        // Mã hóa mật khẩu bảo mật bămbcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Mặc định vai trò: 0 - Client, 1 - Admin; trạng thái kích hoạt: 1 - Hoạt động
        $sql = "INSERT INTO users (username, password, email, fullname, role, avatar, status) 
                VALUES (?, ?, ?, ?, 0, ?, 1)";
        return $this->execute($sql, [$username, $hashed_password, $email, $fullname, $avatar]);
    }

    
    public function usernameExists($username) {
        $sql = "SELECT id FROM users WHERE username = ?";
        return $this->getOne($sql, [$username]) !== false;
    }

    
    public function emailExists($email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        return $this->getOne($sql, [$email]) !== false;
    }

    
    public function updateProfile(int $id, $fullname, $email, $avatar = null) {
        if ($avatar !== null) {
            $sql = "UPDATE users SET fullname = ?, email = ?, avatar = ? WHERE id = ?";
            return $this->execute($sql, [$fullname, $email, $avatar, $id]);
        } else {
            $sql = "UPDATE users SET fullname = ?, email = ? WHERE id = ?";
            return $this->execute($sql, [$fullname, $email, $id]);
        }
    }

    
    public function updatePassword(int $id, string $newPassword) {
        $hashed_password = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        return $this->execute($sql, [$hashed_password, $id]);
    }

    
    public function updateFromAdmin(int $id, $fullname, $email, $role, $status) {
        $sql = "UPDATE users SET fullname = ?, email = ?, role = ?, status = ? WHERE id = ?";
        return $this->execute($sql, [$fullname, $email, $role, $status, $id]);
    }

    
    public function getCount() {
        $sql = "SELECT COUNT(id) as total FROM users WHERE status = 1";
        $data = $this->getOne($sql);
        return $data ? $data['total'] : 0;
    }

    
    public function delete(int $id) {
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}

