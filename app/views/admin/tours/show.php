<h2>Chi tiết tour: <?= $tour['name'] ?></h2>

<div class="card mb-4">
    <div class="card-header">
        <strong>Thông tin cơ bản</strong>
    </div>
    <div class="card-body">
        <p><strong>Loại tour:</strong> <?= $tour['type'] ?></p>
        <p><strong>Giá tour:</strong> <?= number_format($tour['base_price'], 0, ',', '.') ?> VNĐ</p>

        <p><strong>Số người tối thiểu:</strong> <?= $tour['min_people'] ?></p>
        <p><strong>Số người tối đa:</strong> <?= $tour['max_people'] ?></p>

        <p><strong>Hình ảnh:</strong></p>
        <img src="<?= $tour['image'] ?>" width="300" class="border rounded">
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <strong>Lịch trình tour</strong>
    </div>
    <div class="card-body">
        <pre style="white-space: pre-wrap; font-size: 15px;">
<?= htmlspecialchars($tour['tour_schedule']) ?>
        </pre>
    </div>
</div>

<li class="list-group-item">
    <strong>Khách sạn:</strong> <?= $tour['hotel_star'] ?> sao
</li>

<li class="list-group-item">
    <strong>Nhà xe:</strong> <?= $tour['transport_star'] ?> sao
</li>


<a href="index.php?controller=adminTour&action=index" class="btn btn-secondary">Quay lại</a>