<?php /** @var array $favorite_products */ ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="space-y-8 text-left">
        <h3 class="text-xl font-extrabold text-slate-800 border-l-4 border-rose-500 pl-2.5 flex items-center gap-2">
            <i data-lucide="heart" class="w-5 h-5 text-rose-500 fill-rose-500"></i>
            <span>Sản Phẩm Yêu Thích Của Bạn</span>
        </h3>

        <?php if (count($favorite_products) > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($favorite_products as $prod): ?>
                    <div class="bg-white rounded-xl border border-slate-150 overflow-hidden hover:shadow-lg transition flex flex-col h-full group relative">
                        <a 
                            href="<?= BASE_URL ?>?act=remove-favorite&id=<?= $prod['id'] ?>"
                            class="absolute top-2.5 right-2.5 z-10 bg-white/95 text-rose-550 p-2 rounded-full hover:bg-rose-50 transition shadow"
                            title="Xóa khỏi yêu thích"
                        >
                            <i data-lucide="trash-2" class="w-4 h-4 text-rose-500"></i>
                        </a>
                        
                        <div 
                            onclick="window.location.href='<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>'"
                            class="h-44 bg-slate-50 relative cursor-pointer"
                        >
                            <img src="<?= asset($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" class="w-full h-full object-cover group-hover:scale-101 transition" />
                        </div>
                        
                        <div class="p-4 flex flex-col flex-grow justify-between text-left">
                            <div onclick="window.location.href='<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>'" class="cursor-pointer">
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider"><?= htmlspecialchars($prod['category_name']) ?></span>
                                <h4 class="font-bold text-slate-800 text-sm mt-0.5 line-clamp-1 group-hover:text-rose-550 transition"><?= htmlspecialchars($prod['name']) ?></h4>
                                <p class="text-xs text-slate-400 line-clamp-2 mt-1.5"><?= htmlspecialchars($prod['description'] ?: 'Chưa định nghĩa mô tả sản phẩm.') ?></p>
                            </div>
                            
                            <div class="mt-3 pt-3 border-t flex items-center justify-between">
                                <span class="text-xs font-bold text-rose-500"><?= number_format($prod['price'], 0, ',', '.') ?> ₫</span>
                                <form action="<?= BASE_URL ?>?act=add-to-cart" method="POST" class="inline">
                                    <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button 
                                        type="submit"
                                        class="bg-emerald-600 hover:bg-emerald-755 text-white font-bold text-[10px] px-2.5 py-1.5 rounded transition flex items-center space-x-1"
                                    >
                                        <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                                        <span>Thêm giỏ</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-white py-16 text-center rounded-xl border border-slate-205 text-slate-450 space-y-3">
                <i data-lucide="heart" class="w-12 h-12 mx-auto text-slate-300"></i>
                <p class="text-sm font-semibold">Mục yêu thích trống rỗng!</p>
                <p class="text-xs text-slate-400">Hãy duyệt qua cửa hàng và nhấp vào biểu tượng 🤍 để lưu sản phẩm muốn xem sau.</p>
                <div class="pt-2">
                    <a href="<?= BASE_URL ?>?act=products" class="bg-rose-500 text-white font-bold text-xs px-4 py-2 rounded-lg hover:bg-rose-600 transition shadow-sm">🛍️ Khám phá ngay</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
