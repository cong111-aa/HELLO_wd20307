<div class="row justify-content-center">
    <div class="col-xxl-11">

        <!-- Tiêu đề -->
        <div class="mb-5">
            <h3 class="h4 fw-bold text-dark mb-1 position-relative d-inline-block">
                Quản lý điểm danh
                <span class="position-absolute bottom-0 start-0 w-100 border-4 border-warning rounded-3 opacity-70"
                    style="height:5px; transform:translateY(12px);"></span>
            </h3>
            <p class="text-muted mt-2 mb-0">Kiểm tra điểm danh khách hàng theo từng booking</p>
        </div>

        <!-- Bảng danh sách booking -->
        <div class="card-modern shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-4 fw-bold text-dark" width="10%">ID</th>
                                <th class="py-4 fw-bold text-dark">Tour</th>
                                <th class="py-4 fw-bold text-dark" width="20%">Ngày khởi hành</th>
                                <th class="text-center py-4 fw-bold text-dark" width="250">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bookings)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-6">
                                        <div class="py-5">
                                            <i class="bi bi-calendar-x display-1 text-muted opacity-20 d-block mb-4"></i>
                                            <p class="fs-4 text-muted mb-0">Chưa có booking nào cần điểm danh</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($bookings as $b): ?>
                                    <tr class="border-start border-4 border-warning-subtle">
                                        <td class="ps-4 py-4">
                                            <strong>#<?= str_pad($b['id'], 4, '0', STR_PAD_LEFT) ?></strong>
                                        </td>
                                        <td class="py-4">
                                            <strong><?= htmlspecialchars($b['tour_name']) ?></strong>
                                        </td>
                                        <td class="py-4">
                                            <?= date('d/m/Y', strtotime($b['start_date'])) ?>
                                        </td>
                                        <td class="text-center py-4">
                                            <a class="btn btn-warning btn-lg px-5 shadow-sm fw-600"
                                                href="index.php?controller=adminCheckin&action=history&booking_id=<?= $b['id'] ?>"
                                                style="border-radius:12px;">
                                                Xem lịch sử điểm danh
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
        background: #fffbeb !important;
        transform: translateY(-2px);
    }

    .border-start {
        transition: border 0.4s ease;
    }

    tr:hover .border-start {
        border-left-width: 7px !important;
        border-left-color: #f59e0b !important;
    }

    .btn-warning {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
    }
</style>