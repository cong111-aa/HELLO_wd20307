<div class="row justify-content-center">
    <div class="col-xxl-11">

        <!-- Header + Nút tạo booking -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h3 class="h4 fw-bold text-dark mb-1">
                    <i class="bi bi-calendar-check-fill text-primary me-2"></i>
                    Danh sách Booking
                </h3>
                <p class="text-muted mb-0">Quản lý tất cả đơn đặt tour</p>
            </div>
            <a href="index.php?controller=adminBooking&action=create" class="btn btn-success shadow-sm px-4 py-2">
                <i class="bi bi-plus-circle me-2"></i>Tạo Booking Mới
            </a>
        </div>

        <!-- Card -->
        <div class="card-modern shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Tour</th>
                                <th class="text-center">Khách</th>
                                <th class="text-end">Tổng tiền</th>
                                <th class="text-end">Đặt cọc</th>
                                <th>Khởi hành</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center" width="230">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (empty($bookings)): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="bi bi-inbox display-1 text-muted opacity-25 d-block mb-3"></i>
                                        <p class="text-muted fs-5">Chưa có booking nào</p>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($bookings as $b): ?>
                                <?php
                                $total = $b['num_people'] * $b['base_price'];

                                $statusClass = match ($b['status']) {
                                    'pending' => 'bg-warning text-dark',
                                    'deposit' => 'bg-primary',
                                    'running' => 'bg-info',
                                    'waiting_confirm' => 'bg-secondary',
                                    'completed' => 'bg-success',
                                    'canceled' => 'bg-danger',
                                    default => 'bg-secondary'
                                };

                                $statusText = match ($b['status']) {
                                    'pending' => 'Chờ xác nhận',
                                    'deposit' => 'Đã đặt cọc',
                                    'running' => 'Đang chạy',
                                    'waiting_confirm' => 'Chờ admin xác nhận',
                                    'completed' => 'Hoàn thành',
                                    'canceled' => 'Đã hủy',
                                    default => ucfirst($b['status'])
                                };
                                ?>

                                <tr class="border-start border-3 border-primary-subtle">
                                    <td class="ps-4 fw-bold">
                                        #<?= str_pad($b['id'], 4, '0', STR_PAD_LEFT) ?>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3"
                                                style="width:48px;height:48px;">
                                                <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block"><?= htmlspecialchars($b['tour_name']) ?></strong>
                                                <small class="text-muted">Booking #<?= $b['id'] ?></small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-primary fs-6 px-3 py-2">
                                            <i class="bi bi-people me-1"></i>
                                            <?= $b['num_people'] ?> khách
                                        </span>
                                    </td>

                                    <td class="text-end fw-bold text-danger">
                                        <?= number_format($total, 0, ',', '.') ?> ₫
                                    </td>

                                    <td class="text-end">
                                        <?php if ($b['deposit_amount'] > 0): ?>
                                            <span class="fw-bold text-primary">
                                                <?= number_format($b['deposit_amount'], 0, ',', '.') ?> ₫
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <i class="bi bi-calendar-event text-muted me-1"></i>
                                        <?= date('d/m/Y', strtotime($b['start_date'])) ?>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge <?= $statusClass ?> px-3 py-2 fs-6">
                                            <?= $statusText ?>
                                        </span>
                                    </td>

                                    <!-- ACTION -->
                                    <td class="text-center">
                                        <div class="btn-group" role="group">

                                            <!-- XEM (LUÔN CÓ) -->
                                            <a href="index.php?controller=adminBooking&action=show&id=<?= $b['id'] ?>"
                                                class="btn btn-outline-info btn-sm" title="Xem chi tiết">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <?php if (!in_array($b['status'], ['completed', 'waiting_confirm'])): ?>

                                                <!-- SỬA -->
                                                <a href="index.php?controller=adminBooking&action=edit&id=<?= $b['id'] ?>"
                                                    class="btn btn-outline-warning btn-sm" title="Sửa">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <!-- THÊM KHÁCH -->
                                                <a href="index.php?controller=bookingCustomer&action=create&booking_id=<?= $b['id'] ?>"
                                                    class="btn btn-outline-success btn-sm" title="Thêm khách hàng">
                                                    <i class="bi bi-person-plus"></i>
                                                </a>

                                                <!-- XOÁ -->
                                                <a href="index.php?controller=adminBooking&action=delete&id=<?= $b['id'] ?>"
                                                    onclick="return confirm('Xóa booking này?\nDữ liệu liên quan cũng sẽ bị xóa!')"
                                                    class="btn btn-outline-danger btn-sm" title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </a>

                                            <?php endif; ?>

                                            <?php if ($b['status'] === 'waiting_confirm'): ?>
                                                <!-- ADMIN XÁC NHẬN HOÀN THÀNH -->
                                                <form method="post"
                                                    action="index.php?controller=adminBooking&action=updateStatus"
                                                    style="display:inline-block;">
                                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                                    <input type="hidden" name="status" value="completed">
                                                    <button class="btn btn-outline-success btn-sm"
                                                        onclick="return confirm('Xác nhận hoàn thành tour này?')"
                                                        title="Xác nhận hoàn thành">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

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
    }

    .table tr:hover {
        background-color: #f8fafc !important;
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.25s ease;
    }

    .btn-group .btn {
        border-radius: 10px !important;
        margin: 0 2px;
    }

    tr:hover .border-start {
        border-left-color: #6366f1 !important;
        border-left-width: 5px !important;
    }
</style>