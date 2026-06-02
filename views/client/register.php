<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white p-8 rounded-3xl border border-slate-150 shadow-lg space-y-6 text-left">
        
        <div class="text-center space-y-2">
            <span class="text-2xl font-black text-rose-500">Poly<span class="text-slate-800">Shop</span></span>
            <h2 class="text-xl font-black text-slate-800">Đăng Ký Thành Viên</h2>
            <p class="text-xs text-slate-400">Tạo tài khoản ảo để trải nghiệm đầy đủ chức năng dự án môn học PHP</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-100 p-3.5 rounded-xl flex items-start gap-2 text-rose-700 text-xs font-semibold">
                <i data-lucide="alert-circle" class="w-4.5 h-4.5 flex-shrink-0 text-rose-500 mt-0.5"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="bg-emerald-50 border border-emerald-100 p-3.5 rounded-xl flex items-start gap-2 text-emerald-700 text-xs font-semibold">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 flex-shrink-0 text-emerald-500 mt-0.5"></i>
                <div class="space-y-1">
                    <span><?= htmlspecialchars($success) ?></span>
                    <div class="pt-1">
                        <a href="<?= BASE_URL ?>?act=login" class="text-emerald-800 underline font-black">Nhấn Đăng nhập ngay &rarr;</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>?act=register" method="POST" class="space-y-4">
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tên tài khoản đăng nhập <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <i data-lucide="user" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                    <input 
                        type="text" 
                        name="username" 
                        required 
                        placeholder="Ví dụ: namthph69887" 
                        class="w-full border border-slate-205 pl-9 pr-4 py-2.5 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                    />
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Mật khẩu đăng nhập <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <i data-lucide="key-round" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Độ dài từ 6 kí tự..." 
                        class="w-full border border-slate-205 pl-9 pr-4 py-2.5 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                    />
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Địa chỉ email <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                    <input 
                        type="email" 
                        name="email" 
                        required 
                        placeholder="Ví dụ: namthph69887@fpt.edu.vn" 
                        class="w-full border border-slate-205 pl-9 pr-4 py-2.5 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                    />
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Họ và tên của bạn</label>
                <div class="relative">
                    <i data-lucide="text-cursor-input" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
                    <input 
                        type="text" 
                        name="fullname" 
                        placeholder="Ví dụ: Trần Hoài Nam" 
                        class="w-full border border-slate-205 pl-9 pr-4 py-2.5 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                    />
                </div>
            </div>

            <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs py-3 rounded-xl shadow transition uppercase tracking-widest mt-2">Xác Nhận Đăng Ký 🚀</button>
        </form>

        <div class="border-t pt-4 text-center text-xs text-slate-500">
            Bạn đã có tài khoản rồi? <a href="<?= BASE_URL ?>?act=login" class="text-rose-500 font-bold hover:underline">Hãy đăng nhập tại đây</a>
        </div>

    </div>
</div>
