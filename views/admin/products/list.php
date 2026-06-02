<?php /** @var array $products */ ?>
<div class="space-y-6 text-left">
    
    <div class="flex items-center justify-between">
        <div>
            <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest">Sản phẩm / Hàng hóa</span>
            <h2 class="text-xl font-black text-slate-800">Quản Lý Danh Sách Sản Phẩm</h2>
        </div>
        
        <a 
            href="<?= BASE_URL ?>?act=admin-products-create"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs py-2.5 px-5 rounded-xl shadow-md transition flex items-center space-x-1.5"
        >
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Thêm sản phẩm mới</span>
        </a>
    </div>

    
    <div class="bg-white rounded-2xl border border-slate-150 shadow-sm overflow-hidden">
        <div class="overflow-x-auto text-xs">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b text-slate-500 font-extrabold text-[10px] uppercase tracking-wider">
                        <th class="p-4 pl-6 w-20 text-center">ID</th>
                        <th class="p-4 w-28">Hình ảnh</th>
                        <th class="p-4">Tên hàng hóa chiếc</th>
                        <th class="p-4">Danh mục</th>
                        <th class="p-4 text-right">Giá tiền niêm yết</th>
                        <th class="p-4 text-center w-28">Lượt xem</th>
                        <th class="p-4 text-center pr-6 w-44">Thao tác quản lý</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-semibold text-slate-600">
                    <?php if (count($products) > 0): ?>
                        <?php foreach ($products as $prod): ?>
                            <tr class="hover:bg-slate-55/40 transition">
                                <td class="p-4 pl-6 text-center font-mono font-bold text-slate-400"><?= $prod['id'] ?></td>
                                <td class="p-4">
                                    <img src="<?= asset($prod['image']) ?>" alt="Product" class="w-12 h-12 rounded-lg border object-cover bg-slate-50" />
                                </td>
                                <td class="p-4 font-bold text-slate-850 text-sm max-w-xs">
                                    <div class="space-y-0.5">
                                        <p class="truncate"><?= htmlspecialchars($prod['name']) ?></p>
                                        <p class="text-[10px] text-slate-400 line-clamp-1 font-medium font-sans"><?= htmlspecialchars($prod['description'] ?: 'Chưa có mô tả cụ thể...') ?></p>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="bg-indigo-50 text-indigo-600 px-2.5 py-1 rounded-full text-[10px] font-black uppercase"><?= htmlspecialchars($prod['category_name']) ?></span>
                                </td>
                                <td class="p-4 text-right text-rose-550 font-black font-mono text-sm">
                                    <?= number_format($prod['price'], 0, ',', '.') ?> ₫
                                </td>
                                <td class="p-4 text-center text-slate-400 font-medium">
                                    <span class="flex items-center justify-center gap-1">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        <span><?= number_format($prod['views']) ?></span>
                                    </span>
                                </td>
                                <td class="p-4 pr-6 text-center space-x-1 flex items-center justify-center">
                                    <a 
                                        href="<?= BASE_URL ?>?act=admin-products-edit&id=<?= $prod['id'] ?>"
                                        class="bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold border border-amber-200 px-3 py-1.5 rounded-lg transition text-xs flex items-center gap-1"
                                    >
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        <span>Sửa</span>
                                    </a>
                                    
                                    <a 
                                        href="<?= BASE_URL ?>?act=admin-products-delete&id=<?= $prod['id'] ?>"
                                        onclick="return confirm('Bạn có thực sự chắc chắn muốn xóa sản phẩm này này không?')"
                                        class="bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold border border-rose-200 px-3 py-1.5 rounded-lg transition text-xs flex items-center gap-1"
                                    >
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        <span>Xóa</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-16 text-center text-slate-400 space-y-3">
                                <i data-lucide="package-search" class="w-12 h-12 mx-auto text-slate-300"></i>
                                <p class="text-sm font-semibold">Chưa có sản phẩm hàng hóa nào!</p>
                                <p class="text-xs text-slate-400">Hãy nhấp vào nút "Thêm sản phẩm mới" phía trên để điền tên, đơn giá và mô tả.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

