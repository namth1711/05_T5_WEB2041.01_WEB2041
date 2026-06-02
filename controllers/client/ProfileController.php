<?php


require_once __DIR__ . '/../../models/User.php';

class ClientProfileController {
    private User $userModel;

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            redirect(BASE_URL . "?act=login");
        }
        $this->userModel = new User();
    }

    
    public function profile() {
        $error = '';
        $success = '';
        $user_id = $_SESSION['user']['id'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['update_profile'])) {
                $fullname = trim($_POST['fullname']);
                $email = trim($_POST['email']);
                
                $avatar = null;
                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'assets/uploads/';
                    $fileName = time() . '_' . basename($_FILES['avatar']['name']);
                    $targetPath = $uploadDir . $fileName;
                    
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
                        $avatar = $targetPath;
                    }
                }
                
                $res = $this->userModel->updateProfile($user_id, $fullname, $email, $avatar);
                if ($res) {
                    $_SESSION['user'] = $this->userModel->find($user_id); // Cập nhật lại Session
                    $success = 'Cập nhật hồ sơ cá nhân thành công!';
                } else {
                    $error = 'Không có gì thay đổi hoặc xảy ra lỗi cập nhật!';
                }
                
            } elseif (isset($_POST['change_password'])) {
                $old_pw = $_POST['old_password'];
                $new_pw = $_POST['new_password'];
                $confirm_pw = $_POST['confirm_password'];
                
                $current_user = $this->userModel->find($user_id);
                
                if (!password_verify($old_pw, $current_user['password'])) {
                    $error = 'Mật khẩu cũ không chính xác!';
                } elseif ($new_pw !== $confirm_pw) {
                    $error = 'Xác nhận mật khẩu mới không khớp!';
                } elseif (strlen($new_pw) < 6) {
                    $error = 'Mật khẩu phải có độ dài tối thiểu 6 ký tự!';
                } else {
                    $res = $this->userModel->updatePassword($user_id, $new_pw);
                    if ($res) {
                        $success = 'Đổi mật khẩu thành công!';
                    } else {
                        $error = 'Quá trình lưu mật khẩu mới lỗi, xin kiểm tra lại!';
                    }
                }
            }
        }
        
        $currentUser = $this->userModel->find($user_id);
        renderView('client/profile', ['user' => $currentUser, 'error' => $error, 'success' => $success], 'client/main.php');
    }
}

