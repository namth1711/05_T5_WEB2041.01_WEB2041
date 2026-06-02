<?php /** @var array $user */
/** @var string|null $error */ ?>
<div class="max-w-xl mx-auto py-4 text-left">
    <div class="space-y-6">
        
        
        <div>
            <a href="<?= BASE_URL ?>?act=admin-users" class="text-xs text-indigo-650 hover:underline font-bold flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Trở lại cơ sở người dùng</span>
            </a>
            <h2 class="text-xl font-black text-slate-800 mt-2">Sửa Quyền Hạn & Trạng Thái Tài Khoản</h2>
            <p class="text-xs text-slate-404">Đang thao tác tài khoản liên kết: <strong class="text-indigo-650 font-mono">@<?= htmlspecialchars($user['username']) ?></strong></p>
        </div>

        
        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-100 p-3.5 rounded-xl text-rose-700 text-xs font-semibold flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500 flex-shrink-0"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        
        <div class="bg-white p-6 rounded-2xl border border-slate-150 shadow-sm">
            <form action="<?= BASE_URL ?>?act=admin-users-edit&id=<?= $user['id'] ?>" method="POST" class="space-y-5">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-650 uppercase tracking-widest">Họ và tên thành viên</label>
                        <input 
                            type="text" 
                            name="fullname" 
                            value="<?= htmlspecialchars($user['fullname']) ?>"
                            placeholder="Chưa nhập họ tên..." 
                            class="w-full border border-slate-205 px-3.5 py-2.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition"
                        />
                    </div>

                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-655 uppercase tracking-widest">Địa chỉ email <span class="text-rose-500">*</span></label>
                        <input 
                            type="email" 
                            name="email" 
                            required 
                            value="<?= htmlspecialchars($user['email']) ?>"
                            placeholder="Nhập địa chỉ email mới..." 
                            class="w-full border border-slate-205 px-3.5 py-2.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-650 uppercase tracking-widest">Vai trò phân cấp quyền</label>
                        <select 
                            name="role" 
                            required
                            class="w-full border border-slate-205 px-3.5 py-2.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition cursor-pointer"
                        >
                            <option value="0" <?= ($user['role'] == 0) ? 'selected' : '' ?>>Thành viên (Khách hàng)</option>
                            <option value="1" <?= ($user['role'] == 1) ? 'selected' : '' ?>>Quản trị viên (Admin)</option>
                        </select>
                    </div>

                    
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-650 uppercase tracking-widest">Trạng thái hoạt động</label>
                        <select 
                            name="status" 
                            required
                            class="w-full border border-slate-205 px-3.5 py-2.5 rounded-xl outline-none focus:border-indigo-505 text-xs bg-slate-50 focus:bg-white transition cursor-pointer"
                        >
                            <option value="1" <?= ($user['status'] == 1) ? 'selected' : '' ?>>Hoạt động (Active)</option>
                            <option value="0" <?= ($user['status'] == 0) ? 'selected' : '' ?>>Bị phong tỏa (Lock/Suspended)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-2 flex items-center space-x-2">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow transition uppercase tracking-wider">Lưu Thay Đổi 💾</button>
                    <a href="<?= BASE_URL ?>?act=admin-users" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs py-2.5 px-5 rounded-xl transition">Hủy bỏ</a>
                </div>

            </form>
        </div>

    </div>
</div>

