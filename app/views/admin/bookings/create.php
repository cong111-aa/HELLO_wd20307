<div class="row justify-content-center">
    <div class="col-lg-11 col-xl-10">
        <div class="card-modern shadow-lg">
            <div class="card-header bg-gradient text-white text-center py-4"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 18px 18px 0 0;">
                <h3 class="mb-0 fw-bold">
                    Tạo Booking Mới
                </h3>
            </div>

            <div class="card-body p-4 p-md-5">
                <form method="post">

                    <!-- CHỌN LOẠI TOUR -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Loại tour <span class="text-danger">*</span></label>
                        <select id="tour_type" class="form-select form-select-lg" required>
                            <option value="">-- Chọn loại tour --</option>
                            <option value="domestic">Tour trong nước</option>
                            <option value="international">Tour quốc tế</option>
                            <option value="custom">Tour theo yêu cầu</option>
                        </select>
                    </div>

                    <!-- CHỌN TOUR -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tour <span class="text-danger">*</span></label>
                        <select name="tour_id" id="tour_id" class="form-select form-select-lg" required>
                            <option value="">-- Chọn tour --</option>
                        </select>
                    </div>

                    <!-- SCRIPT LỌC TOUR – GIỮ NGUYÊN 100% CỦA BẠN -->
                    <script>
                        document.getElementById("tour_type").addEventListener("change", function () {
                            let type = this.value;

                            fetch(`index.php?controller=adminBooking&action=getToursByType&type=${type}`)
                                .then(res => res.json())
                                .then(tours => {
                                    let list = document.getElementById("tour_id");
                                    list.innerHTML = '<option value="">-- Chọn tour --</option>';

                                    if (tours.length === 0) {
                                        list.innerHTML = '<option>Không có tour phù hợp</option>';
                                        return;
                                    }

                                    tours.forEach(t => {
                                        list.innerHTML += `<option value="${t.id}">${t.name}</option>`;
                                    });
                                });
                        });
                    </script>


                    <!-- THÔNG TIN KHÁCH -->
                    <h5 class="fw-bold text-primary mt-5 mb-4">Thông tin khách hàng</h5>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tên khách hàng <span
                                    class="text-danger">*</span></label>
                            <input name="customer_name" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số điện thoại <span
                                    class="text-danger">*</span></label>
                            <input name="customer_phone" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input name="customer_email" class="form-control form-control-lg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số lượng người <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="num_people" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tiền đặt cọc</label>
                            <input type="number" name="deposit_amount" class="form-control form-control-lg">
                        </div>
                    </div>

                    <!-- NGÀY THÁNG -->
                    <h5 class="fw-bold text-primary mt-5 mb-4">Thời gian tour</h5>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Ngày khởi hành <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control form-control-lg" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Ngày kết thúc <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control form-control-lg" required>
                        </div>
                    </div>

                    <!-- DỊCH VỤ & GHI CHÚ -->
                    <h5 class="fw-bold text-primary mt-5 mb-4">Dịch vụ đi kèm & Ghi chú</h5>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Loại booking</label>
                            <select name="booking_type" class="form-select form-select-lg" required>
                                <option value="retail">Khách lẻ</option>
                                <option value="group">Đoàn</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Chọn Hướng dẫn viên</label>
                            <select name="guide_id" class="form-select form-select-lg" required>
                                <option value="">-- Chọn HDV --</option>
                                <?php foreach ($guides as $g): ?>
                                    <option value="<?= $g['id'] ?>"><?= htmlspecialchars($g['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Khách sạn</label>
                            <select name="hotel_id" class="form-select form-select-lg">
                                <option value="0">-- Không chọn --</option>
                                <?php foreach ($hotels as $h): ?>
                                    <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nhà xe</label>
                            <select name="transport_id" class="form-select form-select-lg">
                                <option value="0">-- Không chọn --</option>
                                <?php foreach ($transports as $t): ?>
                                    <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Yêu cầu đặc biệt</label>
                            <textarea name="special_requests" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <!-- NÚT HÀNH ĐỘNG -->
                    <div class="d-flex flex-wrap gap-3 justify-content-end border-top pt-4 mt-5">
                        <a href="index.php?controller=adminBooking&action=index"
                            class="btn btn-outline-secondary btn-lg px-5">
                            Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                            Tạo Booking Ngay
                        </button>
                    </div>
                </form>
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

    .form-control,
    .form-select {
        border-radius: 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, .25);
    }

    h5.fw-bold {
        position: relative;
        padding-bottom: 10px;
    }

    h5.fw-bold::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
</style>