<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-7 col-xxl-6">
        <div class="card-modern shadow-lg">
            <!-- Header xanh dương chuẩn hệ thống -->
            <div class="card-header bg-gradient text-white text-center py-5"
                style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border-radius: 18px 18px 0 0;">
                <h3 class="mb-1 fw-bold fs-2">
                    Thêm khách hàng mới
                </h3>
                <p class="mb-0 fs-5 opacity-90">
                    Booking #<?= str_pad($booking_id, 4, '0', STR_PAD_LEFT) ?>
                </p>
            </div>

            <div class="card-body p-5">
                <form method="post">

                    <!-- HỌ TÊN -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark fs-5 mb-3">
                            Họ & tên khách <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="full_name" class="form-control form-control-lg"
                            placeholder="Nguyễn Văn A" required>
                    </div>

                    <!-- SỐ ĐIỆN THOẠI -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark fs-5 mb-3">
                            Số điện thoại
                        </label>
                        <input type="text" name="phone" class="form-control form-control-lg" placeholder="0901234567">
                    </div>

                    <!-- CCCD / CMND -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark fs-5 mb-3">
                            Số CCCD / CMND
                        </label>
                        <input type="text" name="cccd" class="form-control form-control-lg" placeholder="012345678901">
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-5">
                        <label class="form-label fw-bold text-dark fs-5 mb-3">
                            Email
                        </label>
                        <input type="email" name="email" class="form-control form-control-lg"
                            placeholder="khach@example.com">
                    </div>

                    <!-- NÚT HÀNH ĐỘNG -->
                    <div class="d-flex flex-wrap gap-3 justify-content-end pt-4 border-top">
                        <a href="index.php?controller=bookingCustomer&action=index&booking_id=<?= $booking_id ?>"
                            class="btn btn-outline-secondary btn-lg px-5 fw-600 shadow-sm">
                            Quay lại danh sách
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5 fw-600 shadow"
                            style="background: linear-gradient(135deg, #6366f1, #4f46e5); border:none;">
                            Lưu khách hàng
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
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .form-control {
        border-radius: 14px !important;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    }

    .btn-primary {
        background:hover {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            transform: translateY(-2px);
        }
    }
</style>