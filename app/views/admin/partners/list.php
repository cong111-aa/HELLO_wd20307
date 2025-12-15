<h2>
    <?= $type === 'hotel' ? 'Danh sách khách sạn' : 'Danh sách nhà xe' ?>
</h2>

<a href="index.php?controller=partner&action=create&type=<?= $type ?>" class="btn btn-primary mb-3">
    + Thêm <?= $type === 'hotel' ? 'khách sạn' : 'nhà xe' ?>
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Liên hệ</th>
            <th>Địa chỉ</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($partners as $p): ?>
            <tr>
                <td><?= $p['name'] ?></td>
                <td><?= $p['contact'] ?></td>
                <td><?= $p['address'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

Click nút → gửi GET
→ controller=partner
→ action=create
→ hiển thị form thêm đối tác
