<?php


require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../models/Product.php';

class ClientFavoriteController {
    private $categoryModel;
    private $productModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->productModel = new Product();
    }

    
    public function favorites() {
        $categories = $this->categoryModel->all();
        
        $fav_ids = isset($_SESSION['favorites']) ? $_SESSION['favorites'] : [];
        $favorite_products = [];
        
        foreach ($fav_ids as $pId) {
            $product = $this->productModel->find($pId);
            if ($product) {
                $favorite_products[] = $product;
            }
        }
        
        renderView('client/favorites', [
            'categories' => $categories,
            'favorite_products' => $favorite_products
        ], 'client/main.php');
    }

    
    public function addFavorite() {
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($productId > 0) {
            if (!isset($_SESSION['favorites'])) {
                $_SESSION['favorites'] = [];
            }
            if (!in_array($productId, $_SESSION['favorites'])) {
                $_SESSION['favorites'][] = $productId;
            }
        }
        redirect(BASE_URL . "?act=favorites");
    }

    
    public function removeFavorite() {
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($productId > 0 && isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = array_values(array_filter($_SESSION['favorites'], function($id) use ($productId) {
                return $id !== $productId;
            }));
        }
        redirect(BASE_URL . "?act=favorites");
    }
}

