<h3 class="mb-4 fw-bold text-primary">
    📋 Lịch sử điểm danh – Booking #<?= htmlspecialchars($booking_id) ?>
</h3>

<?php if (empty($history)): ?>
    <div class="alert alert-info text-center py-4">
        <i class="bi bi-info-circle fs-3"></i><br>
        Chưa có dữ liệu điểm danh cho booking này.
    </div>
<?php else: ?>
    <?php
    // Giữ nguyên logic gom nhóm dữ liệu
    $grouped = [];
    foreach ($history as $row) {
        $date = $row['check_date'];
        $session = $row['session'];
        $grouped[$date][$session][] = $row;
    }

    $sessionLabels = [
        'morning' => 'Buổi sáng',
        'afternoon' => 'Buổi chiều',
        'evening' => 'Buổi tối'
    ];

    // Sắp xếp ngày mới nhất lên đầu
    krsort($grouped);
    ?>

    <div class="row">
        <?php foreach ($grouped as $date => $sessions): ?>
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Header ngày -->
                    <div class="card-header bg-gradient bg-primary text-white py-3">
                        <h5 class="mb-0 fw-bold">
                            📅 <?= date('l, d/m/Y', strtotime($date)) ?>
                        </h5>
                    </div>

                    <div class="card-body p-0">
                        <?php foreach ($sessionLabels as $key => $label): ?>
                            <?php if (!empty($sessions[$key])): ?>
                                <div class="p-4 border-bottom">
                                    <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                                        🌅 <?= $label ?>
                                        <span class="badge bg-light text-dark ms-2">
                                            <?= count($sessions[$key]) ?> khách
                                        </span>
                                    </h6>

                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 align-middle">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th>Khách hàng</th>
                                                    <th class="text-center">Trạng thái</th>
                                                    <th class="text-center">Thời gian</th>
                                                    <th>Hướng dẫn viên</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($sessions[$key] as $h): ?>
                                                    <tr>
                                                        <td class="fw-semibold">
                                                            <?= htmlspecialchars($h['full_name'] ?? 'Khách lẻ') ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if ($h['status'] === 'present'): ?>
                                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                                    ✔ Có mặt
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                                                    ✘ Vắng mặt
                                                                </span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center text-muted">
                                                            <?= $h['checkin_time']
                                                                ? date('H:i', strtotime($h['checkin_time']))
                                                                : '<em class="text-secondary">—</em>'
                                                                ?>
                                                        </td>
                                                        <td>
                                                            <small class="text-muted">
                                                                <?= htmlspecialchars($h['creator_name'] ?? 'Hệ thống') ?>
                                                            </small>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="p-4 text-muted small">
                                    <em>→ <?= $label ?>: Chưa có dữ liệu điểm danh</em>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Nút quay lại -->
<div class="mt-5 text-center">
    <a href="index.php?controller=adminCheckin&action=bookingList"
        class="btn btn-outline-secondary btn-lg px-5 py-3 rounded-pill shadow-sm">
        ← Quay lại danh sách Booking
    </a>
</div>

<!-- Thêm Bootstrap Icons (nếu chưa có) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">