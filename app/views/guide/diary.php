<h3>Nhật ký tour</h3>

<form method="post" class="mb-4">
    <div class="mb-3">
        <label class="form-label">Ngày</label>
        <input type="date" name="date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Hoạt động nổi bật</label>
        <textarea name="highlight" class="form-control" rows="2"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Sự cố</label>
        <textarea name="issues" class="form-control" rows="2"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Cách xử lý</label>
        <textarea name="solutions" class="form-control" rows="2"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Phản hồi khách</label>
        <textarea name="customer_feedback" class="form-control" rows="2"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Ảnh (link, phân cách bằng dấu phẩy)</label>
        <input name="photos" class="form-control">
    </div>
    <button class="btn btn-primary">Lưu nhật ký</button>
</form>

<h4>Danh sách nhật ký</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ngày</th>
            <th>Nổi bật</th>
            <th>Sự cố</th>
            <th>Cách xử lý</th>
            <th>Phản hồi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($diaries as $d): ?>
        <tr>
            <td><?= htmlspecialchars($d['date']) ?></td>
            <td><?= nl2br(htmlspecialchars($d['highlight'])) ?></td>
            <td><?= nl2br(htmlspecialchars($d['issues'])) ?></td>
            <td><?= nl2br(htmlspecialchars($d['solutions'])) ?></td>
            <td><?= nl2br(htmlspecialchars($d['customer_feedback'])) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
