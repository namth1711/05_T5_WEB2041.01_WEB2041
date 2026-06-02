<?php

$viewContent = $viewContent ?? '';
$viewFile = $viewFile ?? '';

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị hệ thống - PolyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-slate-100 text-slate-800 flex min-h-screen">
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed h-full z-30">
        <div class="p-6 border-b border-slate-800">
            <a href="<?= BASE_URL ?>" class="flex items-center space-x-2">
                <span class="text-xl font-black text-rose-500 tracking-tight">Poly<span class="text-white">Shop</span> <span class="text-xs text-indigo-400 font-mono">Admin</span></span>
            </a>
            <p class="text-[10px] text-slate-500 mt-1 uppercase font-mono tracking-wider">Hệ thống quản trị và báo cáo</p>
        </div>

        <nav class="flex-grow p-4 space-y-1">
            <a href="<?= BASE_URL ?>?act=admin-dashboard" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition <?= (!isset($_GET['act']) || $_GET['act'] === 'admin-dashboard') ? 'bg-indigo-600 text-white' : '' ?>">
                <i data-lucide="chart-pie" class="w-4 h-4"></i>
                <span>Tổng quan & Báo cáo</span>
            </a>

            <a href="<?= BASE_URL ?>?act=admin-categories" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition <?= (isset($_GET['act']) && strpos($_GET['act'], 'admin-categories') !== false) ? 'bg-indigo-600 text-white' : '' ?>">
                <i data-lucide="folder-tree" class="w-4 h-4"></i>
                <span>Quản lý danh mục</span>
            </a>

            <a href="<?= BASE_URL ?>?act=admin-products" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition <?= (isset($_GET['act']) && strpos($_GET['act'], 'admin-products') !== false) ? 'bg-indigo-600 text-white' : '' ?>">
                <i data-lucide="boxes" class="w-4 h-4"></i>
                <span>Quản lý sản phẩm</span>
            </a>

            <a href="<?= BASE_URL ?>?act=admin-users" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition <?= (isset($_GET['act']) && strpos($_GET['act'], 'admin-users') !== false) ? 'bg-indigo-600 text-white' : '' ?>">
                <i data-lucide="users" class="w-4 h-4"></i>
                <span>Quản lý tài khoản</span>
            </a>

            <a href="<?= BASE_URL ?>?act=admin-comments" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition <?= (isset($_GET['act']) && strpos($_GET['act'], 'admin-comments') !== false) ? 'bg-indigo-600 text-white' : '' ?>">
                <i data-lucide="message-square-quote" class="w-4 h-4"></i>
                <span>Quản lý bình luận</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800 bg-slate-950/50 space-y-2">
            <div class="flex items-center space-x-3">
                <img src="<?= asset($_SESSION['user']['avatar'] ?? 'assets/uploads/default-avatar.png') ?>" alt="Admin Avatar" class="w-9 h-9 rounded-full border border-slate-700">
                <div class="truncate">
                    <p class="text-sm font-semibold text-white truncate"><?= htmlspecialchars($_SESSION['user']['fullname'] ?? 'Admin') ?></p>
                    <span class="text-xs text-indigo-400">Ban quản trị</span>
                </div>
            </div>
            <a href="<?= BASE_URL ?>" class="block text-center text-xs text-slate-500 hover:text-white transition py-1 mt-2 bg-slate-800 rounded">
                Quay lại Client &rarr;
            </a>
        </div>
    </aside>
    <div class="flex-grow ml-64 flex flex-col min-h-screen bg-slate-50">
        <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-8 sticky top-0 z-20">
            <h2 class="text-lg font-bold text-slate-800 flex items-center space-x-2">
                <i data-lucide="shield-check" class="w-5 h-5 text-indigo-600"></i>
                <span>Bàn làm việc quản trị PolyShop</span>
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-xs text-slate-500 font-mono">Phiên làm việc: <?= date('d/m/Y') ?></span>
                <a href="<?= BASE_URL ?>?act=logout" class="text-xs bg-rose-50 text-rose-600 px-3 py-1.5 rounded-full hover:bg-rose-100 transition flex items-center space-x-1 font-semibold">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    <span>Thoát</span>
                </a>
            </div>
        </header>

        <main class="flex-grow p-8">
            <?php
            if (file_exists($viewContent)) {
                require_once $viewContent;
            } else {
                echo "<div class='text-center py-20 text-slate-500 bg-white rounded-xl shadow-sm border'>View quản trị không tồn tại: " . htmlspecialchars($viewFile ?? '') . "</div>";
            }
            ?>
        </main>

        <footer class="bg-white border-t border-slate-200 py-4 px-8 text-center text-xs text-slate-400">
            &copy; WEB2041.01 - PolyShop Admin Dashboard. Thực hiện bởi SV: NAMTHPH69887
        </footer>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>