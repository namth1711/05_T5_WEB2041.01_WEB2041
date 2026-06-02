
<div class="relative bg-slate-900 overflow-hidden mb-12">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center opacity-25"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative z-10 text-left text-white space-y-6">
        <span class="bg-rose-500/90 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Đại Tiệc Công Nghệ 2026</span>
        <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight max-w-2xl font-sans">
            Thế Giới Thiết Bị <br class="hidden sm:inline" />
            <span class="text-rose-450 border-b-4 border-rose-500 pb-1">Đằng Cấp Hoàn Mỹ</span>
        </h1>
        <p class="text-lg text-slate-300 max-w-lg font-medium">
            Khám phá các sản phẩm thông minh đỉnh cao, trải nghiệm chính sách cam kết chất lượng tuyệt đối từ FPoly.
        </p>
        <div class="pt-4 flex flex-wrap gap-4">
            <a href="<?= BASE_URL ?>?act=products" class="bg-rose-500 hover:bg-rose-600 font-bold px-8 py-3.5 rounded-full shadow-lg transition">🛍️ Mua Sắm Ngay</a>
            <a href="#featured-section" class="border border-slate-400 hover:bg-white hover:text-slate-900 transition font-bold px-8 py-3.5 rounded-full">Khám Phá Nổi Bật</a>
        </div>
    </div>
</div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-left">
    <h2 class="text-2xl font-black text-slate-900 mb-8 border-l-4 border-rose-500 pl-3">Danh Mục Mua Sắm</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach ($categories as $cat): ?>
            <a href="<?= BASE_URL ?>?act=products&category_id=<?= $cat['id'] ?>" class="bg-white p-6 rounded-2xl border border-slate-150 hover:border-rose-300 hover:shadow-md transition text-center space-y-3 block group">
                <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center mx-auto group-hover:scale-110 transition">
                    <i data-lucide="tag" class="w-5 h-5 text-rose-500"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm truncate"><?= htmlspecialchars($cat['name']) ?></h3>
                <p class="text-[11px] text-slate-400 truncate"><?= htmlspecialchars($cat['description'] ?: 'Khám phá sản phẩm') ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>


<div id="featured-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-left">
    <div class="flex items-end justify-between mb-8">
        <div>
            <h2 class="text-2xl font-black text-slate-900 border-l-4 border-rose-500 pl-3">Sản Phẩm Đang Phổ Biến</h2>
            <p class="text-xs text-slate-500 mt-1">Xu hướng công nghệ thịnh hành với lượt truy xuất vượt trội</p>
        </div>
        <a href="<?= BASE_URL ?>?act=products" class="text-sm font-bold text-rose-500 hover:underline">Xem thêm &rarr;</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($featured as $prod): ?>
            <div class="bg-white rounded-2xl border border-slate-150 overflow-hidden hover:shadow-xl hover:border-rose-200 transition flex flex-col h-full group relative">
                
                <a href="<?= BASE_URL ?>?act=add-favorite&id=<?= $prod['id'] ?>" class="absolute top-3.5 right-3.5 z-10 bg-white/95 text-slate-400 hover:text-rose-500 p-2.5 rounded-full shadow transition" title="Lưu danh sách yêu thích">
                    <i data-lucide="heart" class="w-4 h-4"></i>
                </a>
                
                <div class="h-56 bg-slate-50 overflow-hidden relative">
                    <img src="<?= asset($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                    <?php if ($prod['views'] > 100): ?>
                        <span class="absolute bottom-3 left-3 bg-rose-500 text-white text-[10px] uppercase font-bold px-2 py-1 rounded">HOT🔥</span>
                    <?php endif; ?>
                </div>

                <div class="p-6 flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-[10px] text-rose-500 font-bold uppercase tracking-wider bg-rose-50 px-2 py-0.5 rounded"><?= htmlspecialchars($prod['category_name']) ?></span>
                        <h3 class="font-extrabold text-slate-800 text-base mt-2 group-hover:text-rose-500 transition line-clamp-1">
                            <a href="<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>"><?= htmlspecialchars($prod['name']) ?></a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed"><?= htmlspecialchars($prod['description'] ?: 'Chưa có mô tả chi tiết sản phẩm.') ?></p>
                    </div>

                    <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div class="space-y-0.5">
                            <span class="text-[10px] text-slate-400 font-semibold uppercase">Đơn giá:</span>
                            <p class="text-base font-black text-rose-600"><?= number_format($prod['price'], 0, ',', '.') ?> ₫</p>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <a href="<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>" class="bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-600 p-2.5 rounded-xl transition" title="Xem chi tiết">
                                <i data-lucide="eye" class="w-4.5 h-4.5"></i>
                            </a>
                            <form action="<?= BASE_URL ?>?act=add-to-cart" method="POST" class="inline">
                                <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white p-2.5 rounded-xl flex items-center transition shadow-sm" title="Thêm ngay vào giỏ">
                                    <i data-lucide="shopping-cart" class="w-4.5 h-4.5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 text-left">
    <div class="flex items-end justify-between mb-8">
        <div>
            <h2 class="text-2xl font-black text-slate-900 border-l-4 border-rose-500 pl-3">Sản Phẩm Mới Đăng</h2>
            <p class="text-xs text-slate-500 mt-1">Đầy đủ mẫu mã công nghệ tân tiến nhất vừa về kho</p>
        </div>
        <a href="<?= BASE_URL ?>?act=products" class="text-sm font-bold text-rose-500 hover:underline">Xem thêm &rarr;</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($latest as $prod): ?>
            <div class="bg-white rounded-2xl border border-slate-150 overflow-hidden hover:shadow-xl hover:border-rose-200 transition flex flex-col h-full group relative">
                
                <a href="<?= BASE_URL ?>?act=add-favorite&id=<?= $prod['id'] ?>" class="absolute top-3.5 right-3.5 z-10 bg-white/95 text-slate-400 hover:text-rose-500 p-2.5 rounded-full shadow transition" title="Lưu danh sách yêu thích">
                    <i data-lucide="heart" class="w-4 h-4"></i>
                </a>

                <div class="h-56 bg-slate-50 overflow-hidden relative">
                    <img src="<?= asset($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                    <span class="absolute top-3 left-3 bg-emerald-500 text-white text-[9px] uppercase font-bold px-2 py-0.5 rounded-full">MỚI ✨</span>
                </div>

                <div class="p-6 flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-[10px] text-rose-500 font-bold uppercase tracking-wider bg-rose-50 px-2 py-0.5 rounded"><?= htmlspecialchars($prod['category_name']) ?></span>
                        <h3 class="font-extrabold text-slate-800 text-base mt-2 group-hover:text-rose-500 transition line-clamp-1">
                            <a href="<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>"><?= htmlspecialchars($prod['name']) ?></a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed"><?= htmlspecialchars($prod['description'] ?: 'Chưa có mô tả chi tiết sản phẩm.') ?></p>
                    </div>

                    <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div class="space-y-0.5">
                            <span class="text-[10px] text-slate-400 font-semibold uppercase">Đơn giá:</span>
                            <p class="text-base font-black text-rose-600"><?= number_format($prod['price'], 0, ',', '.') ?> ₫</p>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <a href="<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>" class="bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-600 p-2.5 rounded-xl transition" title="Xem chi tiết">
                                <i data-lucide="eye" class="w-4.5 h-4.5"></i>
                            </a>
                            <form action="<?= BASE_URL ?>?act=add-to-cart" method="POST" class="inline">
                                <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white p-2.5 rounded-xl flex items-center transition shadow-sm" title="Thêm ngay vào giỏ">
                                    <i data-lucide="shopping-cart" class="w-4.5 h-4.5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

