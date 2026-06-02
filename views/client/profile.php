<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="space-y-8 text-left">
        <div>
            <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-wider">Hồ sơ cá nhân</span>
            <h2 class="text-2xl font-black text-slate-800">Cập Nhật Thông Tin Tài Khoản</h2>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-100 p-3.5 rounded-xl text-rose-700 text-xs font-semibold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="bg-emerald-50 border border-emerald-100 p-3.5 rounded-xl text-emerald-700 text-xs font-semibold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
                <span><?= htmlspecialchars($success) ?></span>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1 bg-white p-6 rounded-2xl border border-slate-150 shadow-sm flex flex-col items-center justify-center text-center space-y-4">
                <div class="w-28 h-28 rounded-full overflow-hidden border-2 border-rose-500 shadow relative group">
                    <img src="<?= asset($user['avatar'] ?: 'assets/uploads/default-avatar.png') ?>" alt="User Avatar" class="w-full h-full object-cover" />
                </div>
                <div class="space-y-1">
                    <h3 class="font-extrabold text-sm text-slate-800"><?= htmlspecialchars($user['fullname'] ?: $user['username']) ?></h3>
                    <p class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider">Vai trò: <?= ($user['role'] == 1) ? 'Quản trị viên' : 'Thành viên' ?></p>
                </div>
                
                
                <div class="w-full pt-4 border-t text-xs text-slate-500 font-medium font-sans">
                    Username liên kết: <strong class="text-slate-800"><?= htmlspecialchars($user['username']) ?></strong>
                </div>
            </div>

            
            <div class="md:col-span-2 space-y-6">
                
                <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-sm text-slate-800 border-l-4 border-rose-500 pl-2 uppercase tracking-wide">Cập Nhật Thông Tin</h3>
                    <form action="<?= BASE_URL ?>?act=profile" method="POST" enctype="multipart/form-data" class="space-y-4">
                        <input type="hidden" name="update_profile" value="1">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500">Họ và tên của bạn</label>
                                <input 
                                    type="text" 
                                    name="fullname" 
                                    value="<?= htmlspecialchars($user['fullname']) ?>" 
                                    placeholder="Ví dụ: Trần Hoài Nam" 
                                    required
                                    class="w-full border border-slate-205 px-3 py-2 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                                />
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500">Địa chỉ email</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="<?= htmlspecialchars($user['email']) ?>" 
                                    placeholder="Nhập địa chỉ email..." 
                                    required
                                    class="w-full border border-slate-205 px-3 py-2 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50 focus:bg-white transition"
                                />
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-500">Thay đổi ảnh đại diện (Avatar)</label>
                            <input 
                                type="file" 
                                name="avatar" 
                                accept="image/*"
                                class="w-full border p-2 rounded-xl bg-slate-50 text-[11px] text-slate-500 focus:outline-none focus:border-rose-500 transitionfile:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100"
                            />
                        </div>

                        <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow transition">Lưu Thay Đổi</button>
                    </form>
                </div>

                
                <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-sm text-slate-800 border-l-4 border-rose-500 pl-2 uppercase tracking-wide">Đổi Mật Khẩu Khóa</h3>
                    
                    <form action="<?= BASE_URL ?>?act=profile" method="POST" class="space-y-4">
                        <input type="hidden" name="change_password" value="1">
                        
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-500">Mật khẩu cũ hiện tại <span class="text-rose-500">*</span></label>
                            <input 
                                type="password" 
                                name="old_password" 
                                required 
                                placeholder="Nhập để xác minh danh tính..." 
                                class="w-full border border-slate-205 px-3 py-2 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50"
                            />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500">Mật khẩu mới <span class="text-rose-500">*</span></label>
                                <input 
                                    type="password" 
                                    name="new_password" 
                                    required 
                                    placeholder="Độ dài tối thiểu 6 ký tự..." 
                                    class="w-full border border-slate-205 px-3 py-2 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50"
                                />
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-500">Xác nhận mật khẩu mới <span class="text-rose-500">*</span></label>
                                <input 
                                    type="password" 
                                    name="confirm_password" 
                                    required 
                                    placeholder="Nhập lại mật khẩu mới..." 
                                    class="w-full border border-slate-205 px-3 py-2 rounded-xl outline-none focus:border-rose-500 text-xs bg-slate-50"
                                />
                            </div>
                        </div>

                        <button type="submit" class="bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold px-5 py-2.5 rounded-xl shadow transition">Cập Nhật Mật Khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

