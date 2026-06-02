<?php /** @var array $product */ ?>
<?php /** @var array $categories */ ?>
<div class="max-w-ui mx-auto py-4 text-left">
    <div class="space-y-6">
        
        
        <div>
            <a href="<?= BASE_URL ?>?act=admin-products" class="text-xs text-indigo-650 hover:underline font-bold flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Trở lại danh sách sản phẩm</span>
            </a>
            <h2 class="text-xl font-black text-slate-800 mt-2">Hiệu Chỉnh Thiết Bị Sản Phẩm</h2>
            <p class="text-xs text-slate-400">Bạn đang cập nhật cấu hình thiết bị ID <strong class="text-indigo-650 font-mono">#<?= $product['id'] ?></strong></p>
        </div>

        
        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-100 p-3.5 rounded-xl text-rose-700 text-xs font-semibold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500 flex-shrink-0"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        
        <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm">
            <form action="<?= BASE_URL ?>?act=admin-products-edit&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-650 uppercase tracking-widest">Tên sản phẩm <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="name" 
                            required 
                            value="<?= htmlspecialchars($product['name']) ?>"
                            placeholder="Nhập tên sản phẩm..." 
                            class="w-full border border-slate-205 px-3.5 py-2 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition"
                        />
                    </div>

                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-650 uppercase tracking-widest">Đơn giá niêm yết (₫) <span class="text-rose-500">*</span></label>
                        <input 
                            type="number" 
                            name="price" 
                            required 
                            min="1000"
                            value="<?= intval($product['price']) ?>"
                            placeholder="Nhập đơn giá mới..." 
                            class="w-full border border-slate-205 px-3.5 py-2 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-650 uppercase tracking-widest">Danh mục phân loại <span class="text-rose-500">*</span></label>
                        <select 
                            name="category_id" 
                            required
                            class="w-full border border-slate-205 px-3.5 py-2.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition cursor-pointer"
                        >
                            <option value="">-- Chọn một danh mục --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-650 uppercase tracking-widest">Hình ảnh mới (Để chống nếu muốn giữ ảnh cũ)</label>
                        <div class="flex items-center space-x-3 bg-slate-50 p-1.5 rounded-xl border">
                            <img src="<?= asset($product['image']) ?>" alt="Old product image thumbnail" class="w-10 h-10 object-cover rounded-lg border bg-white flex-shrink-0" />
                            <input 
                                type="file" 
                                name="image" 
                                accept="image/*"
                                class="w-full text-[10px] text-slate-500 focus:outline-none cursor-pointer file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100"
                            />
                        </div>
                    </div>
                </div>

                
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-655 uppercase tracking-wide">Mô tả đặc trưng thông số kỹ thuật</label>
                    <textarea 
                        name="description" 
                        rows="5" 
                        placeholder="Nhập giới thiệu..." 
                        class="w-full border border-slate-205 p-3.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition"
                    ><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <div class="pt-2 flex items-center space-x-2">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow transition uppercase tracking-wider">Lưu Thay Đổi 💾</button>
                    <a href="<?= BASE_URL ?>?act=admin-products" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs py-2.5 px-5 rounded-xl transition">Hủy bỏ</a>
                </div>

            </form>
        </div>

    </div>
</div>

