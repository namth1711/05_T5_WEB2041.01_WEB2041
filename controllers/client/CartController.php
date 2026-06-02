<?php


require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Product.php';

class ClientCartController {
    private $categoryModel;
    private $productModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->productModel = new Product();
    }

    
    public function cart() {
        $categories = $this->categoryModel->all();
        
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $cart_items = [];
        
        foreach ($cart as $productId => $qty) {
            $product = $this->productModel->find($productId);
            if ($product) {
                $cart_items[] = [
                    'product' => $product,
                    'quantity' => $qty
                ];
            }
        }
        
        renderView('client/cart', [
            'categories' => $categories,
            'cart_items' => $cart_items
        ], 'client/main.php');
    }

    
    public function addToCart() {
        $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $qty = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        if ($qty < 1) $qty = 1;
        if ($qty > 99) $qty = 99;
        
        if ($productId > 0) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] += $qty;
                if ($_SESSION['cart'][$productId] > 99) {
                    $_SESSION['cart'][$productId] = 99;
                }
            } else {
                $_SESSION['cart'][$productId] = $qty;
            }
        }
        
        redirect(BASE_URL . "?act=cart");
    }

    
    public function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            foreach ($_POST['quantities'] as $productId => $qty) {
                $productId = intval($productId);
                $qty = intval($qty);
                if ($qty <= 0) {
                    unset($_SESSION['cart'][$productId]);
                } else {
                    $_SESSION['cart'][$productId] = min(99, $qty);
                }
            }
        } elseif (isset($_GET['clear']) && $_GET['clear'] === 'all') {
            unset($_SESSION['cart']);
        }
        redirect(BASE_URL . "?act=cart");
    }

    
    public function removeFromCart() {
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($productId > 0 && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        redirect(BASE_URL . "?act=cart");
    }
}

