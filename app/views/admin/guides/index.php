<div class="row justify-content-center">
    <div class="col-xxl-11">

        <!-- Tiêu đề + nút thêm -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-5">
            <h2 class="h3 fw-bold text-dark mb-0 position-relative d-inline-block">
                Quản lý nhân sự
                <span class="position-absolute bottom-0 start-0 w-100 border-4 border-primary rounded-3 opacity-70"
                    style="height:5px; transform:translateY(12px);"></span>
            </h2>

            <a href="index.php?controller=guideAdmin&action=create" class="btn btn-primary btn-lg shadow-sm px-5 fw-600"
                style="border-radius:14px; transition:all .3s;">
                Thêm hướng dẫn viên
            </a>
        </div>

        <!-- Bảng nhân sự – chỉ làm đẹp -->
        <div class="card-modern shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-4 fw-bold text-dark">Tên</th>
                                <th class="py-4 fw-bold text-dark">Chức vụ</th>
                                <th class="py-4 fw-bold text-dark">Email</th>
                                <th class="text-center py-4 fw-bold text-dark" width="180">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $e): ?>
                                <tr
                                    class="border-start border-4 <?= $e['role'] === 'admin' ? 'border-danger-subtle' : 'border-success-subtle' ?>">
                                    <td class="ps-4 py-4">
                                        <strong><?= htmlspecialchars($e['name']) ?></strong>
                                    </td>

                                    <td class="py-4">
                                        <?= $e['role'] === 'admin' ? 'Admin' : 'Hướng dẫn viên' ?>
                                    </td>

                                    <td class="py-4">
                                        <?php if ($e['role'] === 'guide'): ?>
                                            <?= htmlspecialchars($e['email']) ?>
                                        <?php else: ?>
                                            <span class="text-muted">Ẩn</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center py-4">
                                        <?php if ($e['role'] === 'guide'): ?>
                                            <a href="index.php?controller=guideAdmin&action=edit&id=<?= $e['id'] ?>"
                                                class="btn btn-warning btn-sm me-2">Sửa</a>
                                            <a href="index.php?controller=guideAdmin&action=delete&id=<?= $e['id'] ?>"
                                                onclick="return confirm('Xóa hướng dẫn viên này?')"
                                                class="btn btn-danger btn-sm">Xóa</a>
                                        <?php else: ?>
                                            <span class="text-muted small">Không khả dụng</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($employees)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-muted">
                                        <p class="fs-4 mb-0">Chưa có nhân sự nào</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-modern {
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
    }

    .card-modern:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .table tr {
        transition: all 0.3s ease;
    }

    .table tr:hover {
        background: #f8fafc !important;
        transform: translateY(-2px);
    }

    .border-start {
        transition: border 0.4s ease;
    }

    tr:hover .border-start {
        border-left-width: 7px !important;
    }

    .btn-primary,
    .btn-warning,
    .btn-danger {
        border-radius: 10px !important;
        transition: all 0.3s;
    }

    .btn-primary:hover,
    .btn-warning:hover,
    .btn-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
</style>