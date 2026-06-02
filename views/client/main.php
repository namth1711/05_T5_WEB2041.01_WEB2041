<?php

$viewContent = $viewContent ?? '';
$viewFile = $viewFile ?? '';

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= BASE_URL ?>">
    <title>PolyShop - Cửa hàng Công nghệ & Đời sống</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen">

    
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="<?= BASE_URL ?>?act=home" class="flex items-center space-x-2">
                <span class="text-2xl font-black text-rose-500 tracking-tight">Poly<span class="text-gray-800">Shop</span></span>
            </a>
            
            
            <form action="<?= BASE_URL ?>?act=products" method="GET" class="hidden md:flex items-center space-x-2 bg-gray-100 px-3 py-1.5 rounded-full w-96">
                <i data-lucide="search" class="w-4 h-4 text-gray-400"></i>
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." class="bg-transparent border-none outline-none text-sm w-full" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            </form>

            <nav class="flex items-center space-x-6">
                <a href="<?= BASE_URL ?>?act=home" class="text-sm font-medium hover:text-rose-500 transition">Trang chủ</a>
                <a href="<?= BASE_URL ?>?act=products" class="text-sm font-medium hover:text-rose-500 transition">Sản phẩm</a>
                
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="flex items-center space-x-4">
                        <?php if ($_SESSION['user']['role'] == 1): ?>
                            <a href="<?= BASE_URL ?>?act=admin-dashboard" class="text-xs bg-indigo-50 text-indigo-600 font-semibold px-3 py-1 rounded-full hover:bg-indigo-100 transition">Quản trị</a>
                        <?php endif; ?>
                        
                        <a href="<?= BASE_URL ?>?act=profile" class="flex items-center space-x-2 text-sm font-medium">
                            <img src="<?= asset($_SESSION['user']['avatar']) ?>" alt="Avatar" class="w-8 h-8 rounded-full border">
                            <span class="hidden sm:inline-block max-w-[120px] truncate"><?= htmlspecialchars($_SESSION['user']['fullname'] ?: $_SESSION['user']['username']) ?></span>
                        </a>
                        <a href="<?= BASE_URL ?>?act=logout" class="text-xs font-semibold text-gray-500 hover:text-rose-500 transition" title="Đăng xuất">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>?act=login" class="text-sm font-medium text-gray-600 hover:text-rose-500 transition">Đăng nhập</a>
                    <a href="<?= BASE_URL ?>?act=register" class="text-sm bg-rose-500 text-white px-4 py-1.5 rounded-full hover:bg-rose-600 font-medium transition">Đăng ký</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    
    <main class="flex-grow">
        <?php 
        if (file_exists($viewContent)) {
            require_once $viewContent;
        } else {
            echo "<div class='text-center py-20 text-gray-500'>Lỗi 404: View không tồn tại: " . htmlspecialchars($viewFile ?? '') . "</div>";
        }
        ?>
    </main>

    
    <footer class="bg-gray-950 text-gray-400 py-12 mt-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <span class="text-2xl font-black text-rose-500">Poly<span class="text-white">Shop</span></span>
                <p class="text-xs text-gray-500">Hệ thống phân phối và giới thiệu sản phẩm công nghệ tiên tiến hàng đầu Việt Nam.</p>
                <p class="text-xs text-gray-500">Mã SV: NAMTHPH69887</p>
            </div>
            <div>
                <h4 class="text-white text-sm font-semibold mb-3">Về PolyShop</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="#" class="hover:text-white transition">Hệ thống cửa hàng</a></li>
                    <li><a href="#" class="hover:text-white transition">Tuyển dụng thành viên</a></li>
                    <li><a href="#" class="hover:text-white transition">Chính sách bảo hành</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white text-sm font-semibold mb-3">Hỗ trợ khách hàng</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="#" class="hover:text-white transition">Hướng dẫn mua sắm trực tuyến</a></li>
                    <li><a href="#" class="hover:text-white transition">Khiếu nại sản phẩm lỗi</a></li>
                    <li><a href="#" class="hover:text-white transition">Chăm sóc khách hàng VIP</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white text-sm font-semibold mb-3">Bản tin PolyShop</h4>
                <p class="text-xs text-gray-500 mb-2">Đăng ký email để nhận các chương trình giảm giá sớm nhất.</p>
                <div class="flex">
                    <input type="email" placeholder="Email của bạn" class="bg-gray-800 border-none px-3 py-1.5 text-xs text-white rounded-l outline-none w-full">
                    <button class="bg-rose-500 text-white text-xs px-3 rounded-r hover:bg-rose-600 transition">Đăng ký</button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 mt-8 border-t border-gray-900 text-center text-xs text-gray-600">
            &copy; <?= date('Y') ?> PolyShop. Dự án học tập. Thực hiện bởi NAMTHPH69887.
        </div>
    </footer>

    
    <script>
        lucide.createIcons();
    </script>
</body>
</html>


