<?php


require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Product.php';

class ClientCartController {
    private Category $categoryModel;
    private Product $productModel;

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


    public function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(BASE_URL . '?act=cart');
        }

        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';

        // Basic validation
        if (empty($phone) || empty($address)) {
            $_SESSION['checkout_error'] = 'Vui lòng nhập SĐT và Địa chỉ nhận hàng!';
            redirect(BASE_URL . '?act=cart');
        }

        // Vietnamese mobile phone basic pattern: 10 digits starting with 0 and a valid provider prefix
        $phonePattern = '/^0(3|5|7|8|9)\d{8}$/';
        if (!preg_match($phonePattern, $phone)) {
            $_SESSION['checkout_error'] = 'Số điện thoại không đúng định dạng. Ví dụ hợp lệ: 09xxxxxxxx.';
            redirect(BASE_URL . '?act=cart');
        }

        // Ensure cart not empty
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        if (empty($cart)) {
            $_SESSION['checkout_error'] = 'Giỏ hàng rỗng, không thể đặt hàng.';
            redirect(BASE_URL . '?act=cart');
        }

        // Simulate order processing (no DB order persistence in this project scope)
        unset($_SESSION['cart']);
        $_SESSION['checkout_success'] = 'Đặt hàng thành công! Chúng tôi sẽ gọi xác nhận tới SĐT ' . htmlspecialchars($phone);
        redirect(BASE_URL . '?act=cart');
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
                    if (isset($_SESSION['cart'][$productId])) {
                        unset($_SESSION['cart'][$productId]);
                    }
                } else {
                    $_SESSION['cart'][$productId] = min(99, $qty);
                }
            }
        } elseif (isset($_GET['clear']) && $_GET['clear'] === 'all') {
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
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

