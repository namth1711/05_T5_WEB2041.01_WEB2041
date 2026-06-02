<div class="max-w-xl mx-auto py-4 text-left">
    <div class="space-y-6">
        
        
        <div>
            <a href="<?= BASE_URL ?>?act=admin-categories" class="text-xs text-indigo-650 hover:underline font-bold flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Trở lại danh sách danh mục</span>
            </a>
            <h2 class="text-xl font-black text-slate-800 mt-2">Thêm Danh Mục Hàng Mới</h2>
            <p class="text-xs text-slate-400">Thiết lập cấu trúc nhóm sản phẩm con phụ vụ lọc sản phẩm trang Client</p>
        </div>

        
        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-100 p-3.5 rounded-xl text-rose-700 text-xs font-semibold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500 flex-shrink-0"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        
        <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm">
            <form action="<?= BASE_URL ?>?act=admin-categories-create" method="POST" class="space-y-4">
                
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-650 uppercase tracking-wide">Tên danh mục hàng hóa <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        required 
                        placeholder="Ví dụ: Điện thoại thông minh, Tai nghe, v.v.." 
                        class="w-full border border-slate-205 px-3.5 py-2.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition"
                    />
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-655 uppercase tracking-wide">Mô tả tóm tắt tác dụng</label>
                    <textarea 
                        name="description" 
                        rows="4" 
                        placeholder="Mô tả cụ thể về dòng phân khúc sản phẩm này phục vụ khách hàng..." 
                        class="w-full border border-slate-205 p-3.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition"
                    ></textarea>
                </div>

                <div class="pt-2 flex items-center space-x-2">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow transition uppercase tracking-wider">Xác Nhận Thêm Mới 🚀</button>
                    <a href="<?= BASE_URL ?>?act=admin-categories" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs py-2.5 px-5 rounded-xl transition">Hủy bỏ</a>
                </div>

            </form>
        </div>

    </div>
</div>

