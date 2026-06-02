<?php

require_once __DIR__ . '/../controllers/client/HomeController.php';
require_once __DIR__ . '/../controllers/client/AuthController.php';
require_once __DIR__ . '/../controllers/client/ProfileController.php';
require_once __DIR__ . '/../controllers/client/CommentController.php';
require_once __DIR__ . '/../controllers/client/CartController.php';
require_once __DIR__ . '/../controllers/client/FavoriteController.php';

$homeController     = new ClientHomeController();
$authController     = new ClientAuthController();
$commentController  = new ClientCommentController();
$cartController     = new ClientCartController();
$favoriteController = new ClientFavoriteController();

$action = isset($_GET['act']) ? trim($_GET['act']) : 'home';

switch ($action) {
    case 'products':
        $homeController->products();
        break;
        
    case 'detail':
        $homeController->detail();
        break;
        
    case 'login':
        $authController->login();
        break;
        
    case 'register':
        $authController->register();
        break;
        
    case 'logout':
        $authController->logout();
        break;
        
    case 'profile':
        $profileController  = new ClientProfileController();
        $profileController->profile();
        break;
        
    case 'post-comment':
        $commentController->postComment();
        break;

    case 'cart':
        $cartController->cart();
        break;

    case 'add-to-cart':
        $cartController->addToCart();
        break;

    case 'update-cart':
        $cartController->updateCart();
        break;

    case 'remove-from-cart':
        $cartController->removeFromCart();
        break;

    case 'favorites':
        $favoriteController->favorites();
        break;

    case 'add-favorite':
        $favoriteController->addFavorite();
        break;

    case 'remove-favorite':
        $favoriteController->removeFavorite();
        break;
        
    case 'home':
    default:
        $homeController->index();
        break;
}
