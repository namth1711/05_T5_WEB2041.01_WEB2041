<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        
        <aside class="space-y-6 text-left">
            <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm space-y-4">
                <h3 class="font-extrabold text-sm text-slate-800 uppercase tracking-wider border-b pb-3 flex items-center gap-2">
                    <i data-lucide="folder-tree" class="w-4 h-4 text-rose-500"></i>
                    <span>Danh Mục Hàng Hóa</span>
                </h3>
                <nav class="space-y-1">
                    <a href="<?= BASE_URL ?>?act=products" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition <?= ($categoryId == 0) ? 'bg-rose-500 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                        <span>Tất cả sản phẩm</span>
                    </a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="<?= BASE_URL ?>?act=products&category_id=<?= $cat['id'] ?>" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition <?= ($categoryId == $cat['id']) ? 'bg-rose-500 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                            <span><?= htmlspecialchars($cat['name']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </nav>
            </div>

            
            <div class="bg-slate-900 text-white p-6 rounded-2xl space-y-4 shadow-sm relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-rose-500/10 rounded-full"></div>
                <h4 class="font-bold text-xs text-rose-450 uppercase tracking-widest">Tiêu chuẩn PolyShop</h4>
                <div class="space-y-3.5 text-xs text-slate-300">
                    <div class="flex items-start space-x-2.5">
                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0"></i>
                        <p><strong class="text-white">Bảo hành 12 tháng:</strong> Chính hãng từ nhà cung cấp thiết bị.</p>
                    </div>
                    <div class="flex items-start space-x-2.5">
                        <i data-lucide="truck" class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0"></i>
                        <p><strong class="text-white">FPoly Express:</strong> Giao hành nhanh hỏa tốc toàn quốc miễn phí.</p>
                    </div>
                </div>
            </div>
        </aside>

        
        <main class="lg:col-span-3 space-y-6 text-left">
            
            
            <div class="bg-white p-5 rounded-2xl border border-slate-150 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Cửa hàng Polyshop</span>
                    <h2 class="text-lg font-black text-slate-800"><?= htmlspecialchars($title) ?></h2>
                </div>
                
                
                <form action="<?= BASE_URL ?>" method="GET" class="flex items-center space-x-2 bg-slate-50 px-3 py-1.5 rounded-xl border w-full md:w-80">
                    <input type="hidden" name="act" value="products">
                    <?php if ($categoryId > 0): ?>
                        <input type="hidden" name="category_id" value="<?= $categoryId ?>">
                    <?php endif; ?>
                    <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                    <input type="text" name="search" placeholder="Lọc nhanh tên thiết bị..." class="bg-transparent border-none outline-none text-xs w-full" value="<?= htmlspecialchars($searchQuery) ?>">
                </form>
            </div>

            
            <?php if (count($products) > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($products as $prod): ?>
                        <div class="bg-white rounded-2xl border border-slate-150 overflow-hidden hover:shadow-lg hover:border-rose-250 transition flex flex-col h-full group relative">
                            
                            <a href="<?= BASE_URL ?>?act=add-favorite&id=<?= $prod['id'] ?>" class="absolute top-3 right-3 z-10 bg-white/95 text-slate-400 hover:text-rose-500 p-2 rounded-full shadow transition" title="Lưu danh sách yêu thích">
                                <i data-lucide="heart" class="w-4 h-4"></i>
                            </a>

                            <div class="h-44 bg-slate-50 overflow-hidden relative cursor-pointer" onclick="window.location.href='<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>'">
                                <img src="<?= asset($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" class="w-full h-full object-cover group-hover:scale-102 transition" />
                            </div>

                            <div class="p-5 flex flex-col flex-grow justify-between">
                                <div class="cursor-pointer" onclick="window.location.href='<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>'">
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider"><?= htmlspecialchars($prod['category_name']) ?></span>
                                    <h3 class="font-extrabold text-slate-800 text-sm mt-1 group-hover:text-rose-500 transition line-clamp-1"><?= htmlspecialchars($prod['name']) ?></h3>
                                    <p class="text-[11px] text-slate-405 mt-1.5 line-clamp-2 leading-relaxed"><?= htmlspecialchars($prod['description'] ?: 'Không có mô tả sản phẩm.') ?></p>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <div class="space-y-0.5">
                                        <p class="text-xs font-bold text-rose-600"><?= number_format($prod['price'], 0, ',', '.') ?> ₫</p>
                                    </div>
                                    <div class="flex items-center space-x-1.5">
                                        <a href="<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>" class="text-[10px] font-bold text-rose-500 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition">Chi tiết</a>
                                        <form action="<?= BASE_URL ?>?act=add-to-cart" method="POST" class="inline">
                                            <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white p-2 rounded-lg flex items-center transition" title="Cho ngay vào giỏ hàng">
                                                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="bg-white py-20 text-center rounded-2xl border border-dashed text-slate-400 space-y-4">
                    <i data-lucide="package-search" class="w-12 h-12 mx-auto text-slate-300"></i>
                    <p class="text-sm font-semibold">Hiện tại không tìm thấy sản phẩm nào!</p>
                    <p class="text-xs text-slate-400">Bạn vui lòng chuyển sang bộ lọc của danh mục hàng khác hoặc gõ từ khóa tìm kiếm khác xem sao.</p>
                    <a href="<?= BASE_URL ?>?act=products" class="inline-block bg-rose-500 text-white font-bold text-xs px-5 py-2.5 rounded-xl hover:bg-rose-600 transition shadow-sm">Xem Toàn Thư Mục</a>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>

