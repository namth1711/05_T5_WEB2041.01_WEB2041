<?php /** @var array $categories */ ?>
<div class="space-y-6 text-left">
    
    
    <div class="flex items-center justify-between">
        <div>
            <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest">Danh mục hàng hóa</span>
            <h2 class="text-xl font-black text-slate-800">Quản Lý Danh Mục Sản Phẩm</h2>
        </div>
        
        <a 
            href="<?= BASE_URL ?>?act=admin-categories-create"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs py-2.5 px-5 rounded-xl shadow-md transition flex items-center space-x-1.5"
        >
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Thêm danh mục mới</span>
        </a>
    </div>

    
    <div class="bg-white rounded-2xl border border-slate-150 shadow-sm overflow-hidden">
        <div class="overflow-x-auto text-xs">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b text-slate-500 font-extrabold text-[10px] uppercase tracking-wider">
                        <th class="p-4 pl-6 w-20 text-center">ID</th>
                        <th class="p-4">Tên danh mục</th>
                        <th class="p-4">Mô tả tóm tắt</th>
                        <th class="p-4 text-center w-36">Số lượng sản phẩm</th>
                        <th class="p-4 text-center pr-6 w-44">Thao tác quản lý</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-semibold text-slate-600">
                    <?php if (count($categories) > 0): ?>
                        <?php foreach ($categories as $cat): ?>
                            <tr class="hover:bg-slate-55/40 transition">
                                <td class="p-4 pl-6 text-center font-mono font-bold text-slate-400"><?= $cat['id'] ?></td>
                                <td class="p-4 font-bold text-slate-850 text-sm"><?= htmlspecialchars($cat['name']) ?></td>
                                <td class="p-4 text-slate-450 font-medium line-clamp-1 max-w-sm"><?= htmlspecialchars($cat['description'] ?: 'Chưa nhập mô tả cụ thể...') ?></td>
                                <td class="p-4 text-center font-bold text-indigo-600 font-mono text-sm">
                                    <span class="bg-indigo-50 px-2.5 py-1 rounded-full text-indigo-700"><?= number_format($cat['product_count']) ?> chiếc</span>
                                </td>
                                <td class="p-4 pr-6 text-center space-x-1 flex items-center justify-center">
                                    <a 
                                        href="<?= BASE_URL ?>?act=admin-categories-edit&id=<?= $cat['id'] ?>"
                                        class="bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold border border-amber-200 px-3 py-1.5 rounded-lg transition text-xs flex items-center gap-1"
                                    >
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        <span>Sửa</span>
                                    </a>
                                    
                                    <a 
                                        href="<?= BASE_URL ?>?act=admin-categories-delete&id=<?= $cat['id'] ?>"
                                        onclick="return confirm('CẢNH BÁO BẢO MẬT!\n\nBạn có thực sự chắc chắn muốn xóa hẳn danh mục này này không?\nTất cả sản phẩm thuộc danh mục này có thể bị ảnh hưởng trực tiếp.')"
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
                            <td colspan="5" class="py-16 text-center text-slate-400 space-y-3">
                                <i data-lucide="package-search" class="w-12 h-12 mx-auto text-slate-300"></i>
                                <p class="text-sm font-semibold">Chưa thiết lập danh mục sản phẩm nào!</p>
                                <p class="text-xs text-slate-400">Hãy nhấp vào nút "Thêm danh mục mới" phía trên để điền tên và mô tả danh mục.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

