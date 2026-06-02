<?php /** @var array $cart_items */ ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="space-y-8 text-left">
        <h3 class="text-xl font-extrabold text-slate-800 border-l-4 border-emerald-500 pl-2.5 flex items-center gap-2">
            <i data-lucide="shopping-cart" class="w-5 h-5 text-emerald-500"></i>
            <span>Giỏ Hàng Mua Sắm Của Bạn</span>
        </h3>

        <?php if (count($cart_items) > 0): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                
                <div class="lg:col-span-2 space-y-4">
                    <form action="<?= BASE_URL ?>?act=update-cart" method="POST" id="cart_update_form" class="bg-white rounded-xl border border-slate-205 overflow-hidden shadow-sm">
                        <div class="p-4 bg-slate-50 border-b border-slate-150 font-bold text-xs text-slate-550 flex justify-between">
                            <span>Danh sách hàng (<?= count($cart_items) ?> mặt hàng)</span>
                            <button 
                                type="button"
                                onclick="if(confirm('Bạn có chắc muốn xóa sạch giỏ hàng hiện tại?')) { window.location.href='<?= BASE_URL ?>?act=update-cart&clear=all'; }"
                                class="text-rose-500 hover:underline hover:text-rose-600 text-xs flex items-center gap-1 font-bold"
                            >
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                <span>Xóa hết giỏ</span>
                            </button>
                        </div>

                        <div class="divide-y divide-slate-100">
                            <?php 
                            $totalPayment = 0;
                            foreach ($cart_items as $item): 
                                $prod = $item['product'];
                                $quantity = $item['quantity'];
                                $subtotal = $prod['price'] * $quantity;
                                $totalPayment += $subtotal;
                            ?>
                                <div class="p-4 flex items-center gap-4 text-xs">
                                    <img src="<?= asset($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" class="w-16 h-16 object-cover rounded-lg border bg-slate-50 flex-shrink-0" />
                                    
                                    <div class="flex-grow space-y-1">
                                        <a href="<?= BASE_URL ?>?act=detail&id=<?= $prod['id'] ?>" class="text-sm font-bold text-slate-800 hover:text-rose-500 text-left line-clamp-1">
                                            <?= htmlspecialchars($prod['name']) ?>
                                        </a>
                                        <p class="text-slate-400 font-medium">Đơn giá: <?= number_format($prod['price'], 0, ',', '.') ?> ₫</p>
                                    </div>

                                    
                                    <div class="flex items-center space-x-1.5 flex-shrink-0">
                                        <div class="flex items-center border border-slate-200 rounded bg-slate-50 overflow-hidden">
                                            <button 
                                                type="button" 
                                                onclick="adjustCartQty(<?= $prod['id'] ?>, -1)"
                                                class="px-2 py-1 hover:bg-slate-200 text-slate-700 transition font-bold"
                                            >&minus;</button>
                                            
                                            <input 
                                                type="number" 
                                                name="quantities[<?= $prod['id'] ?>]" 
                                                id="qty_input_<?= $prod['id'] ?>"
                                                min="1" 
                                                max="99"
                                                value="<?= $quantity ?>"
                                                class="w-10 text-center font-bold text-xs bg-transparent outline-none border-x border-slate-205 py-0.5"
                                                onchange="validateCartQty(this)"
                                            />
                                            
                                            <button 
                                                type="button" 
                                                onclick="adjustCartQty(<?= $prod['id'] ?>, 1)"
                                                class="px-2 py-1 hover:bg-slate-200 text-slate-700 transition font-bold"
                                            >&plus;</button>
                                        </div>

                                        <a 
                                            href="<?= BASE_URL ?>?act=remove-from-cart&id=<?= $prod['id'] ?>"
                                            class="p-1 text-slate-400 hover:text-rose-500 rounded hover:bg-rose-50 transition ml-2"
                                            title="Xóa khỏi giỏ"
                                        >
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </a>
                                    </div>

                                    
                                    <div class="w-24 text-right flex-shrink-0">
                                        <p class="font-bold text-slate-800"><?= number_format($subtotal, 0, ',', '.') ?> ₫</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="p-4 bg-slate-50 border-t flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs px-4 py-2 rounded-lg transition shadow-sm">
                                Cập nhật số lượng giỏ hàng 🔄
                            </button>
                        </div>
                    </form>

                    <a 
                        href="<?= BASE_URL ?>?act=products"
                        class="inline-flex items-center space-x-1 text-xs text-slate-500 hover:text-rose-500 font-bold transition"
                    >
                        <span>&larr; Tiếp tục tham quan mua sắm sản phẩm khác</span>
                    </a>
                </div>

                
                <div class="space-y-4">
                    <div class="bg-white p-5 rounded-xl border border-slate-205 shadow-sm space-y-4">
                        <h4 class="font-bold text-sm text-slate-800 border-l-4 border-emerald-500 pl-2 uppercase">Hóa Đơn Tổng Kết</h4>
                        
                        <div class="space-y-2 text-xs font-semibold border-b pb-3 text-slate-500">
                            <div class="flex justify-between">
                                <span>Tạm tính hàng:</span>
                                <span><?= number_format($totalPayment, 0, ',', '.') ?> ₫</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Vận chuyển toàn quốc:</span>
                                <span class="text-emerald-600 font-bold">Miễn Phí (FPoly)</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Thuế giá trị gia tăng:</span>
                                <span>Bao gồm</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center text-sm font-bold pt-1 text-slate-800">
                            <span>Tổng thanh toán:</span>
                            <span class="text-lg text-rose-550 font-black"><?= number_format($totalPayment, 0, ',', '.') ?> ₫</span>
                        </div>

                        
                        <div class="space-y-3 pt-3 border-t text-xs text-slate-650">
                            <p class="font-bold text-slate-705 uppercase tracking-wider text-[10px]">Thông Tin Giao Nhận Mô Phỏng</p>
                            <?php if (!empty($_SESSION['checkout_error'])): ?>
                                <div class="bg-rose-50 border border-rose-100 p-3.5 rounded-xl flex items-start gap-2 text-rose-700 text-xs font-semibold">
                                    <i data-lucide="alert-circle" class="w-4.5 h-4.5 flex-shrink-0 text-rose-500 mt-0.5"></i>
                                    <span><?= htmlspecialchars($_SESSION['checkout_error']) ?></span>
                                </div>
                                <?php unset($_SESSION['checkout_error']); ?>
                            <?php endif; ?>

                            <?php if (!empty($_SESSION['checkout_success'])): ?>
                                <div class="bg-emerald-50 border border-emerald-100 p-3.5 rounded-xl flex items-start gap-2 text-emerald-700 text-xs font-semibold">
                                    <i data-lucide="check-circle" class="w-4.5 h-4.5 flex-shrink-0 text-emerald-500 mt-0.5"></i>
                                    <span><?= htmlspecialchars($_SESSION['checkout_success']) ?></span>
                                </div>
                                <?php unset($_SESSION['checkout_success']); ?>
                            <?php endif; ?>

                            <form id="checkout_form" action="<?= BASE_URL ?>?act=place-order" method="POST" onsubmit="return validateCheckoutForm()">
                                <div class="space-y-1">
                                    <label class="font-bold text-slate-450">Tên người nhận</label>
                                    <input 
                                        type="text" 
                                        name="name"
                                        value="<?= htmlspecialchars(isset($_SESSION['user']) ? $_SESSION['user']['fullname'] : 'Nguyễn Khách Hàng') ?>"
                                        required
                                        id="php_checkout_name"
                                        class="w-full border px-3 py-2 rounded-lg bg-slate-50 outline-none focus:border-emerald-500 font-medium"
                                    />
                                </div>

                                <div class="space-y-1">
                                    <label class="font-bold text-slate-450">Số điện thoại liên lạc</label>
                                    <input 
                                        type="tel" 
                                        name="phone"
                                        placeholder="09xxxxxxxx"
                                        required
                                        id="php_checkout_phone"
                                        class="w-full border px-3 py-2 rounded-lg bg-slate-50 outline-none focus:border-emerald-500"
                                    />
                                </div>

                                <div class="space-y-1">
                                    <label class="font-bold text-slate-450 font-sans">Địa chỉ nhận hàng thực tế</label>
                                    <textarea 
                                        rows="2"
                                        name="address"
                                        placeholder="Tòa nhà T, Công viên phần mềm Quang Trung, Quận 12..."
                                        required
                                        id="php_checkout_address"
                                        class="w-full border p-3 py-2 rounded-lg bg-slate-50 outline-none focus:border-emerald-500"
                                    ></textarea>
                                </div>

                                <button 
                                    type="submit"
                                    class="w-full bg-rose-500 text-white hover:bg-rose-600 transition font-bold py-3.5 rounded-xl uppercase tracking-wider text-xs shadow-md mt-2 flex items-center justify-center space-x-1.5"
                                >
                                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    <span>Gửi đơn hàng PHP 🚀</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        <?php else: ?>
            <div class="bg-white py-16 text-center rounded-xl border border-slate-205 text-slate-450 space-y-3">
                <i data-lucide="shopping-cart" class="w-12 h-12 mx-auto text-slate-350"></i>
                <p class="text-sm font-semibold">Giỏ hàng của bạn đang trống!</p>
                <p class="text-xs text-slate-400">Hãy thêm các mặt hàng chất lượng cao của chúng tôi để tiến hành mô phỏng kịch bản đặt hàng PHP cực kì độc đáo.</p>
                <div class="pt-2">
                    <a href="<?= BASE_URL ?>?act=products" class="bg-rose-500 text-white font-bold text-xs px-5 py-2.5 rounded-xl hover:bg-rose-600 transition shadow-sm">🛍️ Tham Quan Sản Phẩm</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function adjustCartQty(productId, amount) {
        var input = document.getElementById('qty_input_' + productId);
        var val = parseInt(input.value) + amount;
        if (isNaN(val) || val < 1) val = 1;
        if (val > 99) val = 99;
        input.value = val;
    }

    function validateCartQty(input) {
        var val = parseInt(input.value);
        if (isNaN(val) || val < 1) val = 1;
        if (val > 99) val = 99;
        input.value = val;
    }
    function validateCheckoutForm() {
        var phoneInput = document.getElementById('php_checkout_phone');
        var addressInput = document.getElementById('php_checkout_address');

        var phone = phoneInput ? phoneInput.value.trim() : '';
        var address = addressInput ? addressInput.value.trim() : '';

        if (!phone || !address) {
            alert('Vui lòng điền Số điện thoại nhận hàng và Địa chỉ nhận hàng!');
            return false;
        }

        var phoneRegex = /^0(3|5|7|8|9)\d{8}$/;
        if (!phoneRegex.test(phone)) {
            alert('Số điện thoại không hợp lệ. Vui lòng nhập định dạng: 09xxxxxxxx');
            return false;
        }

        return true; // allow form submission
    }
</script>

