<?php
function showPartners($partners)
{
    if (empty($partners)) {
        echo '<p class="text-danger">Không có dữ liệu</p>';
        return;
    }
    ?>

    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Tên đối tác</th>
                <th>Loại</th>
                <th>Khu vực</th>
                <th>Liên hệ</th>
                <th>Địa chỉ</th>
                <th>Xếp hạng</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($partners as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= $p['type'] === 'hotel' ? 'Khách sạn' : 'Nhà xe' ?></td>
                    <td>
                        <?= $p['region'] === 'domestic' ? 'Trong nước' : 'Nước ngoài' ?>
                    </td>
                    <td><?= htmlspecialchars($p['contact']) ?></td>
                    <td><?= htmlspecialchars($p['address']) ?></td>

                    <td>
                        <?php for ($i = 1; $i <= $p['rating']; $i++): ?>
                            ⭐
                        <?php endfor; ?>
                    </td>

                    <td>
                        <a href="index.php?controller=partner&action=edit&id=<?= $p['id'] ?>"
                            class="btn btn-warning btn-sm">Sửa</a>
                        <a href="index.php?controller=partner&action=delete&id=<?= $p['id'] ?>"
                            onclick="return confirm('Xóa đối tác này?')" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php } ?>