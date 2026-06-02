<?php

require_once __DIR__ . '/../controllers/admin/DashboardController.php';
require_once __DIR__ . '/../controllers/admin/CategoryController.php';
require_once __DIR__ . '/../controllers/admin/ProductController.php';
require_once __DIR__ . '/../controllers/admin/UserController.php';
require_once __DIR__ . '/../controllers/admin/CommentController.php';

$dashboardController = new AdminDashboardController();
$categoryController  = new AdminCategoryController();
$productController   = new AdminProductController();
$userController      = new AdminUserController();
$commentController   = new AdminCommentController();

$action = isset($_GET['act']) ? trim($_GET['act']) : '';

switch ($action) {
    case 'admin-categories':
        $categoryController->categories();
        break;
    case 'admin-categories-create':
        $categoryController->createCategory();
        break;
    case 'admin-categories-edit':
        $categoryController->editCategory();
        break;
    case 'admin-categories-delete':
        $categoryController->deleteCategory();
        break;
    case 'admin-products':
        $productController->products();
        break;
    case 'admin-products-create':
        $productController->createProduct();
        break;
    case 'admin-products-edit':
        $productController->editProduct();
        break;
    case 'admin-products-delete':
        $productController->deleteProduct();
        break;
    case 'admin-users':
        $userController->users();
        break;
    case 'admin-users-edit':
        $userController->editUser();
        break;
    case 'admin-users-delete':
        $userController->deleteUser();
        break;
    case 'admin-comments':
        $commentController->comments();
        break;
    case 'admin-comments-delete':
        $commentController->deleteComment();
        break;
    case 'admin-dashboard':
    default:
        $dashboardController->dashboard();
        break;
}
