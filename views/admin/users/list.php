<?php /** @var array $users */ ?>
<div class="space-y-6 text-left">
    
    
    <div>
        <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest">Quản lý nội bộ</span>
        <h2 class="text-xl font-black text-slate-800">Cơ Sở Người Dùng Hệ Thống</h2>
        <p class="text-xs text-slate-405 mt-1">Quản trị viên có quyền cập nhật quyền hạn hoặc phong tỏa khóa tài khoản nếu cần thiết.</p>
    </div>

    
    <div class="bg-white rounded-2xl border border-slate-150 shadow-sm overflow-hidden">
        <div class="overflow-x-auto text-xs">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b text-slate-500 font-extrabold text-[10px] uppercase tracking-wider">
                        <th class="p-4 pl-6 w-20 text-center">ID</th>
                        <th class="p-4 w-20">Ảnh</th>
                        <th class="p-4">Tên tài khoản (username)</th>
                        <th class="p-4">Địa chỉ Email</th>
                        <th class="p-4">Họ và tên</th>
                        <th class="p-4 text-center w-36">Quyền hạn</th>
                        <th class="p-4 text-center w-28">Trạng thái</th>
                        <th class="p-4 text-center pr-6 w-52">Hành động quản lý</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-101 font-semibold text-slate-600">
                    <?php foreach ($users as $user): 
                        // Kiểm tra xem có phải tài khoản Admin gốc bất tử không
                        $isSuperAdmin = ($user['id'] == 1 || $user['username'] === 'admin01');
                    ?>
                        <tr class="hover:bg-slate-55/40 transition">
                            <td class="p-4 pl-6 text-center font-mono font-bold text-slate-400"><?= $user['id'] ?></td>
                            <td class="p-4">
                                <img src="<?= asset($user['avatar'] ?: 'assets/uploads/default-avatar.png') ?>" alt="User" class="w-8 h-8 rounded-full border object-cover bg-slate-50" />
                            </td>
                            <td class="p-4 font-bold text-slate-850 font-mono"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="p-4 font-medium text-slate-500"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="p-4 text-slate-700"><?= htmlspecialchars($user['fullname'] ?: 'Chưa nhập họ tên') ?></td>
                            <td class="p-4 text-center font-bold">
                                <?php if ($user['role'] == 1): ?>
                                    <span class="bg-indigo-50 text-indigo-650 px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider font-extrabold">Quản trị</span>
                                <?php else: ?>
                                    <span class="bg-slate-100 text-slate-500 px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider">Thành viên</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 text-center font-bold">
                                <?php if ($user['status'] == 1): ?>
                                    <span class="text-emerald-600 flex items-center justify-center gap-1 text-[11px]"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Hoạt động</span>
                                <?php else: ?>
                                    <span class="text-rose-600 flex items-center justify-center gap-1 text-[11px]"><span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Bị Khóa</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 pr-6 text-center">
                                <?php if ($isSuperAdmin): ?>
                                    
                                    <span class="inline-flex items-center gap-1 text-[11px] text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-xl border border-indigo-100 font-bold" title="Hệ thống bảo vệ tài khoản quản trị sáng lập cốt lõi">
                                        <i data-lucide="shield-check" class="w-3.5 h-3.5 flex-shrink-0"></i>
                                        <span>Bảo mật hệ thống</span>
                                    </span>
                                <?php else: ?>
                                    
                                    <div class="flex items-center justify-center space-x-1">
                                        <a 
                                            href="<?= BASE_URL ?>?act=admin-users-edit&id=<?= $user['id'] ?>"
                                            class="bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold border border-amber-200 px-3 py-1.5 rounded-lg transition text-xs flex items-center gap-1"
                                        >
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                            <span>Sửa</span>
                                        </a>
                                        
                                        <a 
                                            href="<?= BASE_URL ?>?act=admin-users-delete&id=<?= $user['id'] ?>"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn tài khoản người dùng người này không?\nHành vi này sẽ rũ bỏ mọi nhận diện liên kết dữ liệu.')"
                                            class="bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold border border-rose-200 px-3 py-1.5 rounded-lg transition text-xs flex items-center gap-1"
                                        >
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            <span>Xóa</span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

