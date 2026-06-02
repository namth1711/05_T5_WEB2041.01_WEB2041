<?php /** @var array $product */
/** @var array $comments */
/** @var array $related */ ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="space-y-12 text-left">
        
        
        <div class="text-xs text-slate-500 font-semibold space-x-1 flex items-center">
            <a href="<?= BASE_URL ?>" class="hover:text-rose-500 transition">Trang chủ</a>
            <span>/</span>
            <a href="<?= BASE_URL ?>?act=products" class="hover:text-rose-500 transition">Sản phẩm</a>
            <span>/</span>
            <a href="<?= BASE_URL ?>?act=products&category_id=<?= $product['category_id'] ?>" class="hover:text-rose-500 transition truncate"><?= htmlspecialchars($product['category_name']) ?></a>
            <span>/</span>
            <span class="text-slate-800 font-bold truncate"><?= htmlspecialchars($product['name']) ?></span>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            
            <div class="h-96 md:h-[450px] bg-white rounded-3xl overflow-hidden border border-slate-150 p-4 flex items-center justify-center shadow-sm">
                <img src="<?= asset($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="max-h-full max-w-full object-contain rounded-2xl" />
            </div>

            
            <div class="flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <span class="text-[10px] text-rose-500 font-black uppercase tracking-wider bg-rose-50 px-3 py-1 rounded-full"><?= htmlspecialchars($product['category_name']) ?></span>
                    <h1 class="text-2xl md:text-3xl font-black text-slate-900 leading-snug"><?= htmlspecialchars($product['name']) ?></h1>
                    
                    <div class="flex items-center space-x-4 text-xs font-semibold text-slate-450">
                        <span class="flex items-center gap-1">
                            <i data-lucide="eye" class="w-4 h-4 text-slate-400"></i>
                            <span><?= number_format($product['views']) ?> lượt xem</span>
                        </span>
                        <span>|</span>
                        <span class="text-emerald-600">Trạng thái: Còn hàng hỏa tốc</span>
                    </div>

                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 flex items-baseline space-x-2">
                        <span class="text-xs font-bold text-slate-400">Đơn giá áp dụng:</span>
                        <p class="text-2xl font-black text-rose-600"><?= number_format($product['price'], 0, ',', '.') ?> ₫</p>
                    </div>

                    <p class="text-xs text-slate-600 leading-relaxed bg-white border border-slate-150 p-4 rounded-xl">
                        <?= nl2br(htmlspecialchars($product['description'] ?: 'Hiện chưa có mô tả đặc trưng sản phẩm này.')) ?>
                    </p>
                </div>

                
                <form action="<?= BASE_URL ?>?act=add-to-cart" method="POST" class="space-y-4 pt-4 border-t">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Số lượng cần mua:</span>
                        <div class="flex items-center border border-slate-205 rounded-xl bg-slate-50 overflow-hidden">
                            <button type="button" onclick="adjustQty(-1)" class="px-3.5 py-2 hover:bg-slate-200 transition font-black text-slate-600">&minus;</button>
                            <input 
                                type="number" 
                                name="quantity" 
                                id="detail_qty" 
                                value="1" 
                                min="1" 
                                max="99" 
                                class="w-14 text-center font-bold text-xs bg-transparent outline-none py-1 border-x"
                                onchange="validateQty(this)"
                            />
                            <button type="button" onclick="adjustQty(1)" class="px-3.5 py-2 hover:bg-slate-200 transition font-black text-slate-600">&plus;</button>
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">(Tối đa 99 chiếc cho mỗi đơn)</span>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-3.5 px-6 rounded-xl transition flex-grow text-center flex items-center justify-center space-x-2 shadow-sm">
                            <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                            <span>Thêm trực tiếp vào giỏ hàng</span>
                        </button>
                        <a href="<?= BASE_URL ?>?act=add-favorite&id=<?= $product['id'] ?>" class="border border-slate-250 hover:bg-rose-50 hover:border-rose-250 hover:text-rose-500 font-semibold text-xs py-3.5 px-5 rounded-xl transition flex items-center justify-center space-x-2">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                            <span>Lưu Yêu Thích</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 pt-8 border-t">
            
            
            <div class="lg:col-span-1 space-y-4">
                <h3 class="text-lg font-black text-slate-800 border-l-4 border-rose-500 pl-2.5">Ý Kiến Khách Hàng</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Để lại bình luận đánh giá trải nghiệm thực tế để giúp các khách hàng khác đưa ra lựa chọn hàng đầu.</p>
                
                <?php if (isset($_SESSION['user'])): ?>
                    <form action="<?= BASE_URL ?>?act=post-comment" method="POST" class="space-y-3 pt-2">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500">Soạn phản hồi thảo luận:</label>
                            <textarea 
                                name="content" 
                                rows="3" 
                                required 
                                placeholder="Sản phẩm dùng nhạy bén, thiết kế sang trọng lắm..." 
                                class="w-full border border-slate-250 p-3 rounded-lg outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                            ></textarea>
                        </div>
                        <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold py-2.5 rounded-lg transition shadow-sm uppercase tracking-wider">Gửi bình luận 🚀</button>
                    </form>
                <?php else: ?>
                    <div class="bg-rose-50 border border-rose-100 p-4 rounded-xl text-center space-y-2">
                        <i data-lucide="lock" class="w-6 h-6 text-rose-450 mx-auto"></i>
                        <p class="text-xs font-bold text-rose-800">Yêu cầu đăng nhập</p>
                        <p class="text-[11px] text-rose-600 leading-normal">Bạn cần đăng kích hoặc đăng nhập thành viên để được quyền gửi bình luận sản phẩm.</p>
                        <div class="pt-1">
                            <a href="<?= BASE_URL ?>?act=login" class="inline-block bg-rose-500 hover:bg-rose-600 text-white text-[10px] font-bold px-4 py-2 rounded-lg transition">Đến Đăng Nhập</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-lg font-black text-slate-800 border-l-4 border-rose-500 pl-2.5">Các Thảo Luận Hiện Có (<?= count($comments) ?>)</h3>
                
                <?php if (count($comments) > 0): ?>
                    <div class="space-y-4 divide-y divide-slate-100">
                        <?php foreach ($comments as $comment): ?>
                            <div class="pt-4 first:pt-0 flex items-start space-x-3 text-xs text-left">
                                <img src="<?= asset($comment['avatar'] ?: 'assets/uploads/default-avatar.png') ?>" alt="User" class="w-9 h-9 rounded-full border flex-shrink-0" />
                                <div class="space-y-1 bg-slate-50/50 p-3.5 rounded-xl border border-slate-100 flex-grow">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-800"><?= htmlspecialchars($comment['fullname'] ?: $comment['username']) ?></span>
                                        <span class="text-[10px] text-slate-400 font-mono"><?= date('H:i d/m/Y', strtotime($comment['created_at'])) ?></span>
                                    </div>
                                    <p class="text-slate-600 font-medium leading-relaxed font-sans"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-white py-12 text-center rounded-2xl border border-dotted border-slate-150 text-slate-405 space-y-2">
                        <i data-lucide="messages-square" class="w-10 h-10 mx-auto text-slate-300"></i>
                        <p class="text-xs font-semibold">Chưa có ý kiến đánh giá nào!</p>
                        <p class="text-[11px] text-slate-400">Hãy là người tiên phong đưa ra phản hồi thực tế đầu tiên về thiết bị này.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="space-y-6 pt-10 border-t">
            <h3 class="text-xl font-black text-slate-850 border-l-4 border-rose-500 pl-3">Sản Phẩm Đề Xuất Cho Bạn</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach ($related as $rProd): ?>
                    <div class="bg-white rounded-xl border border-slate-150 overflow-hidden hover:shadow group flex flex-col h-full justify-between">
                        <div class="cursor-pointer" onclick="window.location.href='<?= BASE_URL ?>?act=detail&id=<?= $rProd['id'] ?>'">
                            <div class="h-32 bg-slate-50 relative">
                                <img src="<?= asset($rProd['image']) ?>" alt="<?= htmlspecialchars($rProd['name']) ?>" class="w-full h-full object-cover group-hover:scale-102 transition" />
                            </div>
                            <div class="p-3.5 text-left">
                                <h4 class="font-bold text-slate-800 text-xs truncate group-hover:text-rose-500 transition"><?= htmlspecialchars($rProd['name']) ?></h4>
                                <p class="text-xs font-black text-rose-550 mt-1"><?= number_format($rProd['price'], 0, ',', '.') ?> ₫</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<script>
    function adjustQty(amount) {
        var qtyInput = document.getElementById('detail_qty');
        var val = parseInt(qtyInput.value) + amount;
        if (isNaN(val) || val < 1) val = 1;
        if (val > 99) val = 99;
        qtyInput.value = val;
    }

    function validateQty(input) {
        var val = parseInt(input.value);
        if (isNaN(val) || val < 1) val = 1;
        if (val > 99) val = 99;
        input.value = val;
    }
</script>

