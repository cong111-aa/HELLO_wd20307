<h2>Sửa đối tác</h2>

<form method="post">

    <div class="mb-3">
        <label class="form-label">Tên đối tác</label>
        <input name="name" class="form-control" value="<?= htmlspecialchars($partner['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Loại đối tác</label>
        <select name="type" class="form-select">
            <option value="hotel" <?= $partner['type'] == 'hotel' ? 'selected' : '' ?>>Khách sạn</option>
            <option value="transport" <?= $partner['type'] == 'transport' ? 'selected' : '' ?>>Nhà xe</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Khu vực</label>
        <select name="region" class="form-select">
            <option value="domestic" <?= $partner['region'] == 'domestic' ? 'selected' : '' ?>>Trong nước</option>
            <option value="international" <?= $partner['region'] == 'international' ? 'selected' : '' ?>>Nước ngoài</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Liên hệ</label>
        <input name="contact" class="form-control" value="<?= htmlspecialchars($partner['contact']) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input name="address" class="form-control" value="<?= htmlspecialchars($partner['address']) ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Xếp hạng (sao)</label>
        <select name="rating" class="form-select">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>" <?= $partner['rating'] == $i ? 'selected' : '' ?>>
                    <?= $i ?> ⭐
                </option>
            <?php endfor; ?>
        </select>
    </div>

    <button class="btn btn-primary">Lưu thay đổi</button>
    <a href="index.php?controller=partner&action=index" class="btn btn-secondary">Quay lại</a>
</form>