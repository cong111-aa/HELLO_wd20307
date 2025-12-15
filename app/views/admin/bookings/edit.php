<div class="row justify-content-center">
    <div class="col-lg-11 col-xl-10">
        <div class="card-modern shadow-lg">
            <div class="card-header bg-gradient text-white text-center py-4" 
                 style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 18px 18px 0 0;">
                <h3 class="mb-0 fw-bold">
                    Sửa Booking #<?= str_pad($booking['id'], 4, '0', STR_PAD_LEFT) ?>
                </h3>
            </div>

            <div class="card-body p-4 p-md-5">
                <form method="post">

                    <!-- THÔNG TIN TOUR -->
                    <h5 class="fw-bold text-primary mb-4">Thông tin Tour</h5>

                    <div class="row g-4 mb-5">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Chọn Tour</label>
                            <select name="tour_id" class="form-select form-select-lg" required>
                                <?php foreach ($tours as $t): ?>
                                    <option value="<?= $t['id'] ?>" <?= $booking['tour_id'] == $t['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($t['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Lịch trình chi tiết của tour</label>
                            <div id="schedule-box" class="border rounded-4 p-4 bg-light" style="min-height:140px; font-size:15px;">
                                <em class="text-muted">Đang tải lịch trình...</em>
                            </div>
                        </div>
                    </div>

                    <!-- THÔNG TIN KHÁCH HÀNG -->
                    <h5 class="fw-bold text-success mb-4">Thông tin khách hàng</h5>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tên khách hàng</label>
                            <input name="customer_name" class="form-control form-control-lg" 
                                   value="<?= htmlspecialchars($booking['customer_name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số điện thoại</label>
                            <input name="customer_phone" class="form-control form-control-lg" 
                                   value="<?= htmlspecialchars($booking['customer_phone']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input name="customer_email" type="email" class="form-control form-control-lg" 
                                   value="<?= htmlspecialchars($booking['customer_email']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số lượng người</label>
                            <input name="num_people" type="number" class="form-control form-control-lg" 
                                   value="<?= $booking['num_people'] ?>" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tiền đặt cọc (VNĐ)</label>
                            <input name="deposit_amount" type="number" class="form-control form-control-lg" 
                                   value="<?= $booking['deposit_amount'] ?>" min="0">
                        </div>
                    </div>

                    <!-- THỜI GIAN -->
                    <h5 class="fw-bold text-info mb-4">Thời gian tour</h5>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Ngày khởi hành</label>
                            <input type="date" name="start_date" class="form-control form-control-lg" 
                                   value="<?= $booking['start_date'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Ngày kết thúc</label>
                            <input type="date" name="end_date" class="form-control form-control-lg" 
                                   value="<?= htmlspecialchars($booking['end_date']) ?>" required>
                        </div>
                    </div>

                    <!-- DỊCH VỤ & TRẠNG THÁI -->
                    <h5 class="fw-bold text-warning mb-4">Dịch vụ & Trạng thái</h5>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Loại booking</label>
                            <select name="booking_type" class="form-select form-select-lg">
                                <option value="retail" <?= $booking['booking_type'] == 'retail' ? 'selected' : '' ?>>Khách lẻ</option>
                                <option value="group" <?= $booking['booking_type'] == 'group' ? 'selected' : '' ?>>Đoàn</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Hướng dẫn viên</label>
                            <select name="guide_id" class="form-select form-select-lg" required>
                                <option value="">-- Chọn HDV --</option>
                                <?php foreach ($guides as $g): ?>
                                    <option value="<?= $g['id'] ?>" <?= ($booking['guide_id'] ?? '') == $g['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($g['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select name="status" class="form-select form-select-lg">
                                <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Chờ xác nhận</option>
                                <option value="deposit" <?= $booking['status'] == 'deposit' ? 'selected' : '' ?>>Đã cọc</option>
                                <option value="paid" <?= $booking['status'] == 'paid' ? 'selected' : '' ?>>Đã thanh toán</option>
                                <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Hoàn tất</option>
                                <option value="canceled" <?= $booking['status'] == 'canceled' ? 'selected' : '' ?>>Hủy</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Khách sạn</label>
                            <select name="hotel_id" class="form-select form-select-lg">
                                <option value="0">-- Không chọn --</option>
                                <?php foreach ($hotels as $h): ?>
                                    <option value="<?= $h['id'] ?>" <?= $booking['hotel_id'] == $h['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($h['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nhà xe</label>
                            <select name="transport_id" class="form-select form-select-lg">
                                <option value="0">-- Không chọn --</option>
                                <?php foreach ($transports as $t): ?>
                                    <option value="<?= $t['id'] ?>" <?= $booking['transport_id'] == $t['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($t['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Yêu cầu đặc biệt</label>
                            <textarea name="special_requests" class="form-control" rows="4"><?= htmlspecialchars($booking['special_requests']) ?></textarea>
                        </div>
                    </div>

                    <!-- NÚT HÀNH ĐỘNG -->
                    <div class="d-flex flex-wrap gap-3 justify-content-end border-top pt-4 mt-5">
                        <a href="index.php?controller=adminBooking&action=show&id=<?= $booking['id'] ?>" 
                           class="btn btn-outline-secondary btn-lg px-5">
                            Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- GIỮ NGUYÊN 100% SCRIPT CỦA BẠN -->
<script>
    function loadSchedule() {
        let tourId = document.querySelector('select[name="tour_id"]').value;

        fetch(`index.php?controller=adminBooking&action=getSchedule&tour_id=${tourId}`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('schedule-box').innerHTML = html || '<em class="text-muted">Không có lịch trình chi tiết.</em>';
            })
            .catch(() => {
                document.getElementById('schedule-box').innerHTML = '<em class="text-danger">Lỗi tải lịch trình.</em>';
            });
    }

    // Tải khi mở trang
    document.addEventListener('DOMContentLoaded', loadSchedule);

    // Tải lại khi đổi tour
    document.querySelector('select[name="tour_id"]').addEventListener('change', loadSchedule);
</script>

<style>
    .card-modern { 
        border-radius: 18px; 
        overflow: hidden; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    }
    .form-control, .form-select {
        border-radius: 12px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.25rem rgba(99,102,241,.25);
    }
    h5.fw-bold {
        position: relative;
        padding-bottom: 12px;
    }
    h5.fw-bold::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 70px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 3px;
    }
    #schedule-box {
        background: #f8fafc !important;
        border-color: #e2e8f0;
        font-family: 'Courier New', monospace;
        line-height: 1.7;
    }
</style>