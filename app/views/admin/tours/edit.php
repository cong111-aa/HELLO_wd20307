<h2>Sửa Tour</h2>

<form method="post">

    <div class="mb-3">
        <label class="form-label">Tên tour</label>
        <input name="name" class="form-control" value="<?= $tour['name'] ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Loại tour</label>
        <select name="type" class="form-select">
            <option value="domestic" <?= $tour['type'] === 'domestic' ? 'selected' : '' ?>>Tour trong nước</option>
            <option value="international" <?= $tour['type'] === 'international' ? 'selected' : '' ?>>Tour quốc tế</option>
            <option value="custom" <?= $tour['type'] === 'custom' ? 'selected' : '' ?>>Tour theo yêu cầu</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Hình ảnh (URL)</label>
        <input name="image" class="form-control" value="<?= $tour['image'] ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Giá tour (VNĐ)</label>
        <input type="number" name="base_price" class="form-control" value="<?= $tour['base_price'] ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Lịch trình tour</label>
        <textarea name="tour_schedule" class="form-control" rows="6" required><?= $tour['tour_schedule'] ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Số người tối thiểu</label>
        <input type="number" name="min_people" class="form-control" value="<?= $tour['min_people'] ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Số người tối đa</label>
        <input type="number" name="max_people" class="form-control" value="<?= $tour['max_people'] ?>" required>
    </div>
    <div>
        <label for="form-label">khach san</label>
        <select name="hotel_star" class="form-select">
            <option value="0" <?= $tour['hotel_star'] == 0 ? 'selected' : '' ?>>Không yêu cầu</option>
            <option value="1" <?= $tour['hotel_star'] == 1 ? 'selected' : '' ?>>1 sao</option>
            <option value="2" <?= $tour['hotel_star'] == 2 ? 'selected' : '' ?>>2 sao</option>
            <option value="3" <?= $tour['hotel_star'] == 3 ? 'selected' : '' ?>>3 sao</option>
            <option value="4" <?= $tour['hotel_star'] == 4 ? 'selected' : '' ?>>4 sao</option>
            <option value="5" <?= $tour['hotel_star'] == 5 ? 'selected' : '' ?>>5 sao</option>
        </select>
    </div>
    <div>
        <label for="form-label">nha xe</label>
        <select name="transport_star" class="form-select">
            <option value="0" <?= $tour['transport_star'] == 0 ? 'selected' : '' ?>>Không yêu cầu</option>
            <option value="1" <?= $tour['transport_star'] == 1 ? 'selected' : '' ?>>1 sao</option>
            <option value="2" <?= $tour['transport_star'] == 2 ? 'selected' : '' ?>>2 sao</option>
            <option value="3" <?= $tour['transport_star'] == 3 ? 'selected' : '' ?>>3 sao</option>
            <option value="4" <?= $tour['transport_star'] == 4 ? 'selected' : '' ?>>4 sao</option>
            <option value="5" <?= $tour['transport_star'] == 5 ? 'selected' : '' ?>>5 sao</option>
        </select>
    </div>


    <button class="btn btn-primary">Cập nhật tour</button>
</form>