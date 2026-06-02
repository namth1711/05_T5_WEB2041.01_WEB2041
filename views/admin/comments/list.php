<?php /** @var array $comments */ ?>
<div class="space-y-6 text-left">
    
    
    <div>
        <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest">Phản hồi khách hàng</span>
        <h2 class="text-xl font-black text-slate-800">Kiểm Duyệt Thảo Luận Bình Luận</h2>
        <p class="text-xs text-slate-405 mt-1">Quản lý và loại bỏ các bình luận không chuẩn mực, thô tục, bôi nhọ để xây dựng một cộng đồng lành mạnh.</p>
    </div>

    
    <div class="bg-white rounded-2xl border border-slate-150 shadow-sm overflow-hidden">
        <div class="overflow-x-auto text-xs">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b text-slate-500 font-extrabold text-[10px] uppercase tracking-wider">
                        <th class="p-4 pl-6 w-20 text-center">ID</th>
                        <th class="p-4">Người bình luận</th>
                        <th class="p-4">Sản phẩm liên kết</th>
                        <th class="p-4">Nội dung phản hồi</th>
                        <th class="p-4 text-center w-40">Thời gian thảo luận</th>
                        <th class="p-4 text-center pr-6 w-32">Kiểm duyệt</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-101 font-semibold text-slate-655 font-sans">
                    <?php if (count($comments) > 0): ?>
                        <?php foreach ($comments as $comment): ?>
                            <tr class="hover:bg-slate-55/40 transition">
                                <td class="p-4 pl-6 text-center font-mono font-bold text-slate-400"><?= $comment['id'] ?></td>
                                <td class="p-4 font-bold text-slate-800"><?= htmlspecialchars($comment['user_fullname'] ?: 'Thành viên') ?></td>
                                <td class="p-4 font-bold text-indigo-650 max-w-xs truncate" title="<?= htmlspecialchars($comment['product_name']) ?>"><?= htmlspecialchars($comment['product_name']) ?></td>
                                <td class="p-4 text-slate-600 font-medium max-w-sm" style="word-break: break-all;"><?= nl2br(htmlspecialchars($comment['content'])) ?></td>
                                <td class="p-4 text-center font-mono text-[10px] text-slate-400"><?= date('H:i:s d/m/Y', strtotime($comment['created_at'])) ?></td>
                                <td class="p-4 pr-6 text-center flex justify-center items-center">
                                    <a 
                                        href="<?= BASE_URL ?>?act=admin-comments-delete&id=<?= $comment['id'] ?>"
                                        onclick="return confirm('Bạn có chắc muốn thực sự xóa vĩnh viễn bình luận kiểm duyệt này khỏi hệ thống?')"
                                        class="bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold border border-rose-200 px-3 py-1.5 rounded-lg transition text-xs flex items-center gap-1"
                                    >
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        <span>Gỡ bỏ</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-16 text-center text-slate-400 space-y-3">
                                <i data-lucide="message-square-off" class="w-12 h-12 mx-auto text-slate-300"></i>
                                <p class="text-sm font-semibold">Chưa tìm thấy bình luận thảo luận nào!</p>
                                <p class="text-xs text-slate-400">Tất cả các bình luận được viết tại trang Chi tiết sản phẩm bởi người dùng sẽ được lưu trữ trực tiếp tại đây.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

