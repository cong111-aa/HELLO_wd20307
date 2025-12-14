<h2>Thêm Tour</h2>

<form method="post">

    <div class="mb-3">
        <label class="form-label">Tên tour</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Loại tour</label>
        <select name="type" class="form-select">
            <option value="domestic">Tour trong nước</option>
            <option value="international">Tour quốc tế</option>
            <option value="custom">Tour theo yêu cầu</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Hình ảnh (URL)</label>
        <input name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Giá tour (VNĐ)</label>
        <input type="number" name="base_price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Lịch trình tour</label>
        <textarea name="tour_schedule" class="form-control" rows="6" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Số người tối thiểu</label>
        <input type="number" name="min_people" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Số người tối đa</label>
        <input type="number" name="max_people" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Hạng khách sạn</label>
        <select name="hotel_star" class="form-select">
            <option value="0">Không yêu cầu</option>
            <option value="1">1 sao</option>
            <option value="2">2 sao</option>
            <option value="3">3 sao</option>
            <option value="4">4 sao</option>
            <option value="5">5 sao</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Hạng nhà xe</label>
        <select name="transport_star" class="form-select">
            <option value="0">Không yêu cầu</option>
            <option value="1">1 sao</option>
            <option value="2">2 sao</option>
            <option value="3">3 sao</option>
            <option value="4">4 sao</option>
            <option value="5">5 sao</option>
        </select>
    </div>


    <button class="btn btn-primary">Lưu tour</button>
</form>