<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white p-8 rounded-3xl border border-slate-150 shadow-lg space-y-6 text-left">
        
        <div class="text-center space-y-2">
            <span class="text-2xl font-black text-rose-500">Poly<span class="text-slate-800">Shop</span></span>
            <h2 class="text-xl font-black text-slate-800">Đăng Nhập Khách Hàng</h2>
            <p class="text-xs text-slate-400">Đăng nhập tài khoản để viết bình luận và trải nghiệm giỏ hàng</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-100 p-3.5 rounded-xl flex items-start gap-2 text-rose-700 text-xs font-semibold">
                <i data-lucide="alert-circle" class="w-4.5 h-4.5 flex-shrink-0 text-rose-500 mt-0.5"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>?act=login" method="POST" class="space-y-4">
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tên tài khoản</label>
                <div class="relative">
                    <i data-lucide="user" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                    <input 
                        type="text" 
                        name="username" 
                        required 
                        placeholder="Nhập tên đăng nhập của bạn..." 
                        class="w-full border border-slate-205 pl-9 pr-4 py-2.5 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                    />
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Mật khẩu bảo mật</label>
                <div class="relative">
                    <i data-lucide="key-round" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Nhập mật khẩu đã đăng ký..." 
                        class="w-full border border-slate-205 pl-9 pr-4 py-2.5 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-55 focus:bg-white transition"
                    />
                </div>
            </div>

            <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs py-3 rounded-xl shadow transition uppercase tracking-widest mt-2">Đăng Nhập Ngay 🚀</button>
        </form>

        <div class="space-y-3 pt-4 border-t text-xs text-center text-slate-500">
            <div>
                Bạn chưa có tài khoản thành viên? <a href="<?= BASE_URL ?>?act=register" class="text-rose-500 font-bold hover:underline">Đăng ký tại đây</a>
            </div>
        </div>

    </div>
</div>
