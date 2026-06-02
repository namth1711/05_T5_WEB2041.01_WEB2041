<?php


require_once __DIR__ . '/../../models/Category.php';

class AdminCategoryController {
    private $categoryModel;

    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            redirect(BASE_URL . '?act=login');
        }
        $this->categoryModel = new Category();
    }

    public function categories() {
        $categories = $this->categoryModel->allWithCount();
        renderView('admin/categories/list', ['categories' => $categories], 'admin/main.php');
    }

    public function createCategory() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            
            if (empty($name)) {
                $error = 'Tên danh mục sản phẩm không được phép để trống!';
            } else {
                $this->categoryModel->insert($name, $description);
                redirect(BASE_URL . '?act=admin-categories');
            }
        }
        renderView('admin/categories/create', ['error' => $error], 'admin/main.php');
    }

    public function editCategory() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $category = $this->categoryModel->find($id);
        if (!$category) redirect(BASE_URL . '?act=admin-categories');
        
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            
            if (empty($name)) {
                $error = 'Tên danh mục sản phẩm không được phép để trống!';
            } else {
                $this->categoryModel->update($id, $name, $description);
                redirect(BASE_URL . '?act=admin-categories');
            }
        }
        renderView('admin/categories/edit', ['category' => $category, 'error' => $error], 'admin/main.php');
    }

    public function deleteCategory() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $this->categoryModel->delete($id);
        redirect(BASE_URL . '?act=admin-categories');
    }
}

