<?php


require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Product.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Comment.php';

class AdminDashboardController {
    private Category $categoryModel;
    private Product $productModel;
    private User $userModel;
    private Comment $commentModel;

    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            redirect(BASE_URL . '?act=login');
        }
        
        $this->categoryModel = new Category();
        $this->productModel = new Product();
        $this->userModel = new User();
        $this->commentModel = new Comment();
    }

    
    public function dashboard() {
        $totalProducts = count($this->productModel->all());
        $totalCategories = count($this->categoryModel->all());
        $totalUsers = $this->userModel->getCount();
        $totalComments = count($this->commentModel->all());
        
        // Dữ liệu báo cáo thống kê mức độ danh mục
        $categoryStats = $this->productModel->getStats();
        // Dữ liệu bình luận theo sản phẩm
        $commentStats = $this->commentModel->getStatsByProduct();
        
        $data = [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalUsers' => $totalUsers,
            'totalComments' => $totalComments,
            'categoryStats' => $categoryStats,
            'commentStats' => $commentStats
        ];
        
        renderView('admin/dashboard', $data, 'admin/main.php');
    }
}

