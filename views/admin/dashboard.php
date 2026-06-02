
<?php /** @var int $totalProducts */
/** @var int $totalCategories */
/** @var int $totalUsers */
/** @var int $totalComments */
/** @var array $categoryStats */
/** @var array $commentStats */ ?>
<div class="space-y-8 text-left">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tổng sản phẩm</span>
                <p class="text-3xl font-black text-slate-800"><?= number_format($totalProducts) ?></p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="boxes" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tổng danh mục</span>
                <p class="text-3xl font-black text-slate-800"><?= number_format($totalCategories) ?></p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="folder-tree" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tài khoản hoạt động</span>
                <p class="text-3xl font-black text-slate-800"><?= number_format($totalUsers) ?></p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ý kiến bình luận</span>
                <p class="text-3xl font-black text-slate-800"><?= number_format($totalComments) ?></p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i data-lucide="message-square-quote" class="w-6 h-6"></i>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl border border-slate-150 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-5 border-b border-slate-150 flex items-center justify-between">
                    <h3 class="font-bold text-sm text-slate-800 flex items-center gap-2">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 text-indigo-600"></i>
                        <span>Thống Kê Sản Phẩm Theo Danh Mục</span>
                    </h3>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tự động cập nhật</span>
                </div>

                <div class="overflow-x-auto text-xs">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b text-slate-500 font-extrabold text-[10px] uppercase tracking-wider">
                                <th class="p-4 pl-6">ID</th>
                                <th class="p-4">Tên danh mục</th>
                                <th class="p-4 text-center">Số thiết bị</th>
                                <th class="p-4 text-right">Giá tối thiểu</th>
                                <th class="p-4 text-right">Giá tối đa</th>
                                <th class="p-4 text-right pr-6">Giá trung bình</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-600">
                            <?php foreach ($categoryStats as $row): ?>
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-slate-400"><?= $row['id'] ?></td>
                                    <td class="p-4 font-bold text-slate-800"><?= htmlspecialchars($row['name']) ?></td>
                                    <td class="p-4 text-center font-bold text-indigo-650"><?= number_format($row['total_products']) ?></td>
                                    <td class="p-4 text-right text-slate-500"><?= number_format($row['min_price'] ?: 0, 0, ',', '.') ?> ₫</td>
                                    <td class="p-4 text-right text-rose-500 font-bold"><?= number_format($row['max_price'] ?: 0, 0, ',', '.') ?> ₫</td>
                                    <td class="p-4 text-right pr-6 text-slate-400"><?= number_format($row['avg_price'] ?: 0, 0, ',', '.') ?> ₫</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-150 text-right">
                <a href="<?= BASE_URL ?>?act=admin-categories" class="text-xs text-indigo-600 font-bold hover:underline">Quản lý danh mục &rarr;</a>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-150 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-5 border-b border-slate-150 flex items-center justify-between">
                    <h3 class="font-bold text-sm text-slate-800 flex items-center gap-2">
                        <i data-lucide="message-square" class="w-5 h-5 text-indigo-600"></i>
                        <span>Thống Kê Bình Luận Theo Hàng Hóa</span>
                    </h3>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest font-sans">Độ ưu tiên ý kiến</span>
                </div>

                <div class="overflow-x-auto text-xs">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b text-slate-500 font-extrabold text-[10px] uppercase tracking-wider">
                                <th class="p-4 pl-6">ID</th>
                                <th class="p-4">Tên hàng hóa</th>
                                <th class="p-4 text-center">Tổng bình luận</th>
                                <th class="p-4">Ý kiến cũ nhất</th>
                                <th class="p-4 pr-6">Ý kiến mới nhất</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-650">
                            <?php if (count($commentStats) > 0): ?>
                                <?php foreach ($commentStats as $row): ?>
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-4 pl-6 font-mono font-bold text-slate-400"><?= $row['id'] ?></td>
                                        <td class="p-4 font-bold text-slate-800 line-clamp-1"><?= htmlspecialchars($row['product_name']) ?></td>
                                        <td class="p-4 text-center font-bold text-amber-600"><?= number_format($row['total_comments']) ?> Phản hồi</td>
                                        <td class="p-4 text-slate-400 font-mono text-[10px]"><?= date('H:i d/m/Y', strtotime($row['oldest_comment'])) ?></td>
                                        <td class="p-4 pr-6 text-slate-500 font-mono text-[10px] font-bold"><?= date('H:i d/m/Y', strtotime($row['conversion_latest'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-slate-400 space-y-2">
                                        <i data-lucide="messages-square" class="w-8 h-8 mx-auto text-slate-250"></i>
                                        <p class="text-xs font-semibold">Chưa phát hiện phản hồi bình luận nào cần báo cáo!</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-150 text-right">
                <a href="<?= BASE_URL ?>?act=admin-comments" class="text-xs text-indigo-600 font-bold hover:underline">Quản lý phản hồi khách hàng &rarr;</a>
            </div>
        </div>

    </div>
</div>