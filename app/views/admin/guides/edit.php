<div class="row justify-content-center">
    <div class="col-lg-9 col-xl-8 col-xxl-7">
        <div class="card-modern shadow-lg animate__animated animate__fadeIn">
            <!-- Header xanh lá – tím chuẩn hệ thống -->
            <div class="card-header bg-gradient text-white text-center py-5 position-relative overflow-hidden"
                style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 18px 18px 0 0;">
                <h2 class="mb-0 fw-bold fs-1">
                    Sửa hướng dẫn viên
                </h2>
            </div>

            <div class="card-body p-5">
                <form method="post">

                    <!-- Tên -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark fs-5">
                            Tên hướng dẫn viên <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control form-control-lg"
                            value="<?= htmlspecialchars($employee['name']) ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark fs-5">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" class="form-control form-control-lg"
                            value="<?= htmlspecialchars($employee['email']) ?>" required>
                    </div>

                    <!-- Mật khẩu -->
                    <div class="mb-5">
                        <label class="form-label fw-bold text-dark fs-5">
                            Mật khẩu (nhập mới nếu muốn đổi)
                        </label>
                        <input type="text" name="password" class="form-control form-control-lg"
                            placeholder="Để trống nếu không đổi mật khẩu" value="">
                        <div class="form-text mt-2">
                            Hiện tại: <code><?= htmlspecialchars($employee['password_hash']) ?></code>
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="d-flex flex-wrap gap-3 justify-content-end pt-4 border-top">
                        <a href="index.php?controller=guideAdmin&action=index"
                            class="btn btn-outline-secondary btn-lg px-5 fw-600 shadow-sm" style="border-radius:14px;">
                            Quay lại
                        </a>
                        <button type="submit" class="btn btn-success btn-lg px-5 fw-600 shadow"
                            style="background: linear-gradient(135deg, #10b981, #059669); border:none; border-radius:14px;">
                            Lưu thay đổi
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
        transition: all 0.4s ease;
    }

    .card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 35px 70px rgba(16, 185, 129, 0.2);
    }

    .form-control {
        border-radius: 14px !important;
        padding: 0.9rem 1.3rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 0.3rem rgba(16, 185, 129, 0.25);
    }

    .btn-success,
    .btn-outline-secondary {
        transition: all 0.3s ease;
    }

    .btn-success:hover,
    .btn-outline-secondary:hover {
        transform: translateY(-4px);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />