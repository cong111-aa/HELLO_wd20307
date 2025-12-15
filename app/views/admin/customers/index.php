<div class="row justify-content-center">
    <div class="col-xxl-11">

        <!-- Header + Nút thêm & quay lại -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h3 class="h4 fw-bold text-dark mb-1">
                    Danh sách khách hàng
                </h3>
                <p class="text-muted mb-0 fs-5">
                    Booking #<?= str_pad($booking_id, 4, '0', STR_PAD_LEFT) ?>
                    <span class="badge bg-primary fs-6 ms-2"><?= count($customers) ?> khách</span>
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="index.php?controller=bookingCustomer&action=create&booking_id=<?= $booking_id ?>"
                    class="btn btn-success shadow-sm px-4 py-2 fw-600">
                    Thêm khách hàng
                </a>
                <a href="index.php?controller=adminBooking&action=show&id=<?= $booking_id ?>"
                    class="btn btn-outline-secondary shadow-sm px-4 py-2">
                    Quay lại Booking
                </a>
            </div>
        </div>

        <!-- Card danh sách khách -->
        <div class="card-modern shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom border-3 border-primary-subtle">
                            <tr>
                                <th class="ps-4 py-4 fw-bold text-dark" width="30%">Họ & tên</th>
                                <th class="py-4 fw-bold text-dark" width="20%">Số điện thoại</th>
                                <th class="py-4 fw-bold text-dark" width="25%">CCCD / CMND</th>
                                <th class="py-4 fw-bold text-dark" width="25%">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($customers)): ?>
                                <?php foreach ($customers as $index => $c): ?>
                                    <tr class="border-start border-4 border-primary-subtle">
                                        <td class="ps-4 py-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-primary fw-bold"
                                                    style="width:48px; height:48px; font-size:1.3rem;">
                                                    <?= strtoupper(mb_substr($c['full_name'], 0, 2)) ?>
                                                </div>
                                                <div>
                                                    <strong
                                                        class="d-block fs-5"><?= htmlspecialchars($c['full_name']) ?></strong>
                                                    <small class="text-muted">Khách thứ <?= $index + 1 ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <?php if ($c['phone']): ?>
                                                <a href="tel:<?= htmlspecialchars($c['phone']) ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($c['phone']) ?>
                                                </a>
                                            <?php else: ?>
                                                <em class="text-muted">Chưa có</em>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-4">
                                            <?= $c['cccd'] ? htmlspecialchars($c['cccd']) : '<em class="text-muted">Chưa nhập</em>' ?>
                                        </td>
                                        <td class="py-4">
                                            <?php if ($c['email']): ?>
                                                <a href="mailto:<?= htmlspecialchars($c['email']) ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($c['email']) ?>
                                                </a>
                                            <?php else: ?>
                                                <em class="text-muted">Chưa có</em>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-6">
                                        <div class="text-center py-5">
                                            <i class="bi bi-people display-1 text-muted opacity-20 d-block mb-4"></i>
                                            <p class="fs-4 text-muted mb-3">Chưa có khách hàng nào</p>
                                            <a href="index.php?controller=bookingCustomer&action=create&booking_id=<?= $booking_id ?>"
                                                class="btn btn-success px-5 py-3 shadow">
                                                Thêm khách đầu tiên
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer tổng hợp -->
                <?php if (!empty($customers)): ?>
                    <div class="border-top bg-light px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Tổng cộng</span>
                            <span class="h5 fw-bold text-primary mb-0">
                                <?= count($customers) ?> khách hàng
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .card-modern {
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    }

    .table tr:hover {
        background-color: #f8faff !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.1);
        transition: all 0.3s ease;
    }

    .border-start {
        transition: border 0.4s ease;
    }

    tr:hover .border-start {
        border-left-color: #6366f1 !important;
        border-left-width: 6px !important;
    }

    .badge {
        font-size: 1.8rem;
    }
</style>