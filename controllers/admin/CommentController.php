<?php


require_once __DIR__ . '/../../models/Comment.php';

class AdminCommentController {
    private $commentModel;

    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            redirect(BASE_URL . '?act=login');
        }
        $this->commentModel = new Comment();
    }

    public function comments() {
        $comments = $this->commentModel->all();
        renderView('admin/comments/list', ['comments' => $comments], 'admin/main.php');
    }

    public function deleteComment() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $this->commentModel->delete($id);
        redirect(BASE_URL . '?act=admin-comments');
    }
}

