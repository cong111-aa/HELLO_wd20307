<h3>Lịch làm việc của tôi</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tour</th>
            <th>Loại</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($assignments as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a['tour_name']) ?></td>
                <td><?= htmlspecialchars($a['type']) ?></td>
                <td><?= htmlspecialchars($a['start_date']) ?></td>
                <td><?= htmlspecialchars($a['end_date']) ?></td>
                <td>
                    <a href="index.php?controller=guide&action=diary&assignment_id=<?= $a['id'] ?>"
                        class="btn btn-sm btn-primary">Nhật ký</a>
                    <a href="index.php?controller=guideCheckin&action=index&booking_id=<?= $a['booking_id'] ?>&assignment_id=<?= $a['id'] ?>"
                        class="btn btn-secondary">
                        Check-in
                    </a>





                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>