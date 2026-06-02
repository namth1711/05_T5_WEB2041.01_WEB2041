<?php


require_once __DIR__ . '/../../models/User.php';

class AdminUserController {
    private User $userModel;

    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            redirect(BASE_URL . '?act=login');
        }
        $this->userModel = new User();
    }

    public function users() {
        $users = $this->userModel->all();
        renderView('admin/users/list', ['users' => $users], 'admin/main.php');
    }

    public function editUser() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $user = $this->userModel->find($id);
        if (!$user) redirect(BASE_URL . '?act=admin-users');
        
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname']);
            $email = trim($_POST['email']);
            $role = intval($_POST['role']);
            $status = intval($_POST['status']);
            
            if (empty($email)) {
                $error = 'Email không được để trống!';
            } else {
                $this->userModel->updateFromAdmin($id, $fullname, $email, $role, $status);
                // Nếu tự cập nhật vai trò của chính mình khiến mất quyền admin, chuyển hướng trang chủ
                if ($id == $_SESSION['user']['id'] && $role != 1) {
                    $_SESSION['user']['role'] = $role;
                    redirect(BASE_URL);
                }
                redirect(BASE_URL . '?act=admin-users');
            }
        }
        renderView('admin/users/edit', ['user' => $user, 'error' => $error], 'admin/main.php');
    }

    public function deleteUser() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        // Không cho phép tự xóa tài khoản của chính mình khi đang đăng nhập
        if ($id != $_SESSION['user']['id']) {
            $this->userModel->delete($id);
        }
        redirect(BASE_URL . '?act=admin-users');
    }
}

