<h2>Danh sách Tour</h2>

<a href="index.php?controller=adminTour&action=create" class="btn btn-primary mb-3">+ Thêm tour</a>

<!-- TOUR TRONG NƯỚC -->
<h3 class="mt-4">Tour trong nước</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($domestic)): ?>
            <tr><td colspan="4" class="text-center">Không có tour</td></tr>
        <?php endif; ?>

        <?php foreach ($domestic as $t): ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= htmlspecialchars($t['name']) ?></td>
                <td><?= number_format($t['base_price'], 0, ',', '.') ?> VND</td>
                <td>
                    <a href="index.php?controller=adminTour&action=show&id=<?= $t['id'] ?>" class="btn btn-info btn-sm">Xem</a>
                    <a href="index.php?controller=adminTour&action=edit&id=<?= $t['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="index.php?controller=adminTour&action=delete&id=<?= $t['id'] ?>"
                       onclick="return confirm('Xóa tour này?')"
                       class="btn btn-danger btn-sm">
                        Xóa
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- TOUR QUỐC TẾ -->
<h3 class="mt-4">Tour quốc tế</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($international)): ?>
            <tr><td colspan="4" class="text-center">Không có tour</td></tr>
        <?php endif; ?>

        <?php foreach ($international as $t): ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= htmlspecialchars($t['name']) ?></td>
                <td><?= number_format($t['base_price'], 0, ',', '.') ?> VND</td>
                <td>
                    <a href="index.php?controller=adminTour&action=show&id=<?= $t['id'] ?>" class="btn btn-info btn-sm">Xem</a>
                    <a href="index.php?controller=adminTour&action=edit&id=<?= $t['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="index.php?controller=adminTour&action=delete&id=<?= $t['id'] ?>"
                       onclick="return confirm('Xóa tour này?')"
                       class="btn btn-danger btn-sm">
                        Xóa
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- TOUR THEO YÊU CẦU -->
<h3 class="mt-4">Tour theo yêu cầu</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($custom)): ?>
            <tr><td colspan="4" class="text-center">Không có tour</td></tr>
        <?php endif; ?>

        <?php foreach ($custom as $t): ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= htmlspecialchars($t['name']) ?></td>
                <td><?= number_format($t['base_price'], 0, ',', '.') ?> VND</td>
                <td>
                    <a href="index.php?controller=adminTour&action=show&id=<?= $t['id'] ?>" class="btn btn-info btn-sm">Xem</a>
                    <a href="index.php?controller=adminTour&action=edit&id=<?= $t['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="index.php?controller=adminTour&action=delete&id=<?= $t['id'] ?>"
                       onclick="return confirm('Xóa tour này?')"
                       class="btn btn-danger btn-sm">
                        Xóa
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
