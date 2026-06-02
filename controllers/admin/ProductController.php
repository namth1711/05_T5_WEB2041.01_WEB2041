<?php


require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Product.php';

class AdminProductController {
    private Category $categoryModel;
    private Product $productModel;

    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            redirect(BASE_URL . '?act=login');
        }
        $this->categoryModel = new Category();
        $this->productModel = new Product();
    }

    public function products() {
        $products = $this->productModel->all();
        renderView('admin/products/list', ['products' => $products], 'admin/main.php');
    }

    public function createProduct() {
        $error = '';
        $categories = $this->categoryModel->all();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $price = floatval($_POST['price']);
            $category_id = intval($_POST['category_id']);
            $description = trim($_POST['description']);
            
            // Xử lý upload ảnh sản phẩm vào thư mục assets/images/
            $image = 'assets/uploads/default-product.png';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'assets/images/';
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $image = $fileName;
                }
            }
            
            if (empty($name) || $price <= 0 || $category_id <= 0) {
                $error = 'Tên hàng hóa, danh mục và đơn giá phải hợp lệ!';
            } else {
                $this->productModel->insert($name, $price, $image, $description, $category_id);
                redirect(BASE_URL . '?act=admin-products');
            }
        }
        renderView('admin/products/create', ['categories' => $categories, 'error' => $error], 'admin/main.php');
    }

    public function editProduct() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $product = $this->productModel->find($id);
        if (!$product) redirect(BASE_URL . '?act=admin-products');
        
        $error = '';
        $categories = $this->categoryModel->all();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $price = floatval($_POST['price']);
            $category_id = intval($_POST['category_id']);
            $description = trim($_POST['description']);
            
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'assets/images/';
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $image = $fileName;
                }
            }
            
            if (empty($name) || $price <= 0 || $category_id <= 0) {
                $error = 'Không được bỏ trống tên sản phẩm, danh mục và giá tiền!';
            } else {
                $this->productModel->update($id, $name, $price, $image, $description, $category_id);
                redirect(BASE_URL . '?act=admin-products');
            }
        }
        renderView('admin/products/edit', ['product' => $product, 'categories' => $categories, 'error' => $error], 'admin/main.php');
    }

    public function deleteProduct() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $this->productModel->delete($id);
        redirect(BASE_URL . '?act=admin-products');
    }
}

