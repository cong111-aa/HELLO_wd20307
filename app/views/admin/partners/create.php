<h2>Thêm đối tác</h2>

<form method="post">

    <div class="mb-3">
        <label class="form-label">Tên đối tác</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Loại đối tác</label>
        <select name="type" class="form-select">
            <option value="hotel">Khách sạn</option>
            <option value="transport">Nhà xe</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Khu vực</label>
        <select name="region" class="form-select">
            <option value="domestic">Trong nước</option>
            <option value="international">Nước ngoài</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Liên hệ</label>
        <input name="contact" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input name="address" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Xếp hạng (sao)</label>
        <select name="rating" class="form-select">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?> ⭐</option>
            <?php endfor; ?>
        </select>
    </div>

    <button class="btn btn-primary">Lưu</button>
    <a href="index.php?controller=partner&action=index" class="btn btn-secondary">Hủy</a>
</form>