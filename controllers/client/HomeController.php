<?php


require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Product.php';
require_once __DIR__ . '/../../models/Comment.php';

class ClientHomeController {
    private $categoryModel;
    private $productModel;
    private $commentModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->productModel = new Product();
        $this->commentModel = new Comment();
    }

    
    public function index() {
        $categories = $this->categoryModel->all();
        $latestProducts = $this->productModel->getLatest(6);
        $featuredProducts = $this->productModel->getFeatured(6);
        
        $data = [
            'categories' => $categories,
            'latest' => $latestProducts,
            'featured' => $featuredProducts
        ];
        
        renderView('client/home', $data, 'client/main.php');
    }

    
    public function products() {
        $categories = $this->categoryModel->all();
        $catId = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
        
        if ($catId > 0) {
            $products = $this->productModel->allByCategory($catId);
            $selectedCategory = $this->categoryModel->find($catId);
            $title = "Danh mục: " . ($selectedCategory ? $selectedCategory['name'] : '');
        } elseif (!empty($searchQuery)) {
            $products = $this->productModel->search($searchQuery);
            $title = "Kết quả tìm kiếm cho: '" . htmlspecialchars($searchQuery) . "'";
        } else {
            $products = $this->productModel->all();
            $title = "Tất cả sản phẩm";
        }
        
        $data = [
            'categories' => $categories,
            'products' => $products,
            'title' => $title,
            'categoryId' => $catId,
            'searchQuery' => $searchQuery
        ];
        
        renderView('client/products', $data, 'client/main.php');
    }

    
    public function detail() {
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($productId === 0) {
            redirect(BASE_URL . '?act=home');
        }
        
        // Tăng lượt xem sản phẩm
        $this->productModel->incrementViews($productId);
        
        $product = $this->productModel->find($productId);
        if (!$product) {
            redirect(BASE_URL . '?act=home');
        }
        
        $comments = $this->commentModel->getByProduct($productId);
        $categories = $this->categoryModel->all();
        $relatedProducts = $this->productModel->getLatest(4);
        
        $data = [
            'product' => $product,
            'comments' => $comments,
            'categories' => $categories,
            'related' => $relatedProducts
        ];
        
        renderView('client/detail', $data, 'client/main.php');
    }
}

