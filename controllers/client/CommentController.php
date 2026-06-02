<?php


require_once __DIR__ . '/../../models/Comment.php';

class ClientCommentController {
    private Comment $commentModel;

    public function __construct() {
        $this->commentModel = new Comment();
    }

    
    public function postComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user'])) {
                redirect(BASE_URL . "?act=login");
            }
            
            $content = trim($_POST['content']);
            $productId = intval($_POST['product_id']);
            $userId = $_SESSION['user']['id'];
            
            if (!empty($content) && $productId > 0) {
                $this->commentModel->insert($content, $productId, $userId);
            }
            
            redirect(BASE_URL . "?act=detail&id=" . $productId);
        }
    }
}

