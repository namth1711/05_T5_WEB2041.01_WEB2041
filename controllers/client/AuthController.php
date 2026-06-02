<?php


require_once __DIR__ . '/../../models/User.php';

class ClientAuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    
    public function register() {
        if (isset($_SESSION['user'])) {
            redirect(BASE_URL . '?act=home');
        }

        $error = '';
        $success = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);
            $fullname = trim($_POST['fullname']);
            
            if (empty($username) || empty($password) || empty($email)) {
                $error = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
            } elseif ($this->userModel->usernameExists($username)) {
                $error = 'Tài khoản đăng nhập này đã tồn tại!';
            } elseif ($this->userModel->emailExists($email)) {
                $error = 'Địa chỉ email này đã được sử dụng!';
            } else {
                $res = $this->userModel->register($username, $password, $email, $fullname);
                if ($res) {
                    redirect(BASE_URL . '?act=login');
                } else {
                    $error = 'Đã có lỗi xảy ra trong quá trình đăng ký, hãy thử lại!';
                }
            }
        }
        
        renderView('client/register', ['error' => $error, 'success' => $success], 'client/main.php');
    }

    
    public function login() {
        if (isset($_SESSION['user'])) {
            redirect(BASE_URL . '?act=home');
        }

        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            if (empty($username) || empty($password)) {
                $error = 'Vui lòng nhập tên tài khoản và mật khẩu!';
            } else {
                $user = $this->userModel->login($username, $password);
                if ($user) {
                    $_SESSION['user'] = $user;
                    if (isset($user['role']) && $user['role'] == 1) {
                        redirect(BASE_URL . '?act=admin-dashboard');
                    }
                    redirect(BASE_URL . '?act=home');
                } else {
                    $error = 'Tên tài khoản hoặc mật khẩu không chính xác!';
                }
            }
        }
        
        renderView('client/login', ['error' => $error], 'client/main.php');
    }

    
    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        redirect(BASE_URL . '?act=home');
    }
}

