<?php
function safe($v)
{
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

$isCompleted = $booking['status'] === 'completed';
$isWaitingConfirm = $booking['status'] === 'waiting_confirm';
?>

<div class="row justify-content-center">
    <div class="col-xxl-11">

        <!-- HEADER -->
        <div class="d-flex flex-wrap justify-content-between align-items-start mb-4 gap-3">
            <div>
                <h3 class="h4 fw-bold text-dark mb-1">
                    Booking #<?= str_pad($booking['id'], 4, '0', STR_PAD_LEFT) ?>
                </h3>
                <div class="text-muted">
                    <?= safe($booking['tour_name']) ?> •
                    Khởi hành: <?= date('d/m/Y', strtotime($booking['start_date'])) ?>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="index.php?controller=bookingCustomer&action=index&booking_id=<?= $booking['id'] ?>"
                    class="btn btn-outline-primary">
                    Danh sách khách (<?= $booking['num_people'] ?>)
                </a>

                <a href="index.php?controller=bookingPayment&action=index&booking_id=<?= $booking['id'] ?>"
                    class="btn btn-outline-success">
                    Lịch sử thanh toán
                </a>
            </div>
        </div>

        <div class="row g-4">

            <!-- ================= CỘT TRÁI ================= -->
            <div class="col-lg-8">

                <!-- THÔNG TIN BOOKING -->
                <div class="card-modern shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-4">Thông tin Booking</h5>

                        <div class="row g-4">

                            <!-- Khách hàng -->
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-4">
                                    <small class="text-muted">Khách hàng đặt</small>
                                    <strong class="d-block"><?= safe($booking['customer_name']) ?></strong>
                                    <small>
                                        <?= safe($booking['customer_phone']) ?> •
                                        <?= safe($booking['customer_email']) ?>
                                    </small>
                                </div>
                            </div>

                            <!-- Hướng dẫn viên -->
                            <div class="col-md-6">
                                <div class="p-3 bg-info bg-opacity-10 rounded-4">
                                    <small class="text-muted">Hướng dẫn viên</small>
                                    <strong class="d-block">
                                        <?= safe($booking['guide_name'] ?: 'Chưa phân công') ?>
                                    </strong>
                                    <?php if (!empty($booking['guide_email'])): ?>
                                        <small><?= safe($booking['guide_email']) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Thống kê -->
                            <div class="col-12">
                                <div class="row text-center g-3 mt-2">
                                    <div class="col">
                                        <div class="p-3 bg-primary bg-opacity-10 rounded-4">
                                            <strong><?= $booking['num_people'] ?></strong><br>
                                            <small>Khách</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-3 bg-success bg-opacity-10 rounded-4">
                                            <strong><?= number_format($totalPaid, 0, ',', '.') ?> ₫</strong><br>
                                            <small>Đã thanh toán</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="p-3 bg-warning bg-opacity-10 rounded-4">
                                            <strong><?= number_format($booking['deposit_amount'], 0, ',', '.') ?>
                                                ₫</strong><br>
                                            <small>Đặt cọc</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- LỊCH TRÌNH -->
                <div class="card-modern shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-info mb-4">Lịch trình chi tiết</h5>

                        <?php if (!empty($schedule)): ?>
                            <?php foreach ($schedule as $day): ?>
                                <div class="mb-3 p-3 bg-light rounded-4 border-start border-primary border-4">
                                    <strong>Ngày <?= $day['day_number'] ?>:</strong>
                                    <div><?= nl2br(safe($day['activities'])) ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Chưa có lịch trình</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ================= CỘT PHẢI ================= -->
            <div class="col-lg-4">

                <!-- TRẠNG THÁI -->
                <div class="card-modern shadow-sm mb-4 text-center">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Trạng thái Booking</h5>

                        <?php
                        $statusMap = [
                            'pending' => ['Chờ xác nhận', 'bg-warning text-dark'],
                            'deposit' => ['Đã đặt cọc', 'bg-primary'],
                            'running' => ['Đang chạy', 'bg-info'],
                            'waiting_confirm' => ['Chờ admin xác nhận', 'bg-secondary'],
                            'completed' => ['Hoàn thành', 'bg-success'],
                            'canceled' => ['Đã hủy', 'bg-danger']
                        ];
                        ?>

                        <span class="badge <?= $statusMap[$booking['status']][1] ?> fs-6 px-4 py-2">
                            <?= $statusMap[$booking['status']][0] ?>
                        </span>
                    </div>
                </div>

                <!-- ADMIN XÁC NHẬN HOÀN THÀNH -->
                <?php if ($isWaitingConfirm): ?>
                    <div class="card-modern shadow-sm mb-4">
                        <div class="card-body p-4 text-center">
                            <a href="index.php?controller=adminBooking&action=confirmCompleted&id=<?= $booking['id'] ?>"
                                class="btn btn-success w-100" onclick="return confirm('Xác nhận hoàn thành tour này?')">
                                ✅ Xác nhận hoàn thành tour
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- NÚT -->
                <div class="d-grid gap-2">
                    <?php if (!$isCompleted && !$isWaitingConfirm): ?>
                        <a href="index.php?controller=adminBooking&action=edit&id=<?= $booking['id'] ?>"
                            class="btn btn-warning">
                            Chỉnh sửa Booking
                        </a>
                    <?php endif; ?>

                    <a href="index.php?controller=adminBooking&action=index" class="btn btn-outline-secondary">
                        Quay lại danh sách
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>