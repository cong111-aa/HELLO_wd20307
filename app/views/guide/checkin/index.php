<h3>Điểm danh khách – Booking #<?= $booking_id ?></h3>

<?php if ($booking['status'] === 'waiting_confirm'): ?>
    <div class="alert alert-warning">
        ⏳ Tour đã hoàn thành và đang <strong>chờ admin xác nhận</strong>.
        Bạn chỉ có thể xem điểm danh và nhật ký.
    </div>
<?php elseif ($booking['status'] === 'completed'): ?>
    <div class="alert alert-success">
        ✅ Tour đã được admin xác nhận <strong>hoàn thành</strong>.
    </div>
<?php endif; ?>

<?php foreach ($days as $date): ?>
    <h5 class="mt-4">
        📅 Ngày <?= date('d/m/Y', strtotime($date)) ?>
    </h5>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th width="220">Khách</th>
                <?php foreach ($sessions as $s): ?>
                    <th class="text-center">
                        <?= $s === 'morning' ? 'Sáng' : ($s === 'afternoon' ? 'Trưa' : 'Tối') ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($customers as $c): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($c['full_name']) ?></strong><br>
                        <small class="text-muted"><?= htmlspecialchars($c['phone']) ?></small>
                    </td>

                    <?php foreach ($sessions as $s): ?>
                        <?php
                        $status = $checked[$c['id']][$date][$s] ?? null;
                        ?>

                        <td class="text-center">
                            <?php if ($status === 'present'): ?>
                                <span class="badge bg-success">Có mặt</span>

                            <?php elseif ($status === 'absent'): ?>
                                <span class="badge bg-danger">Vắng mặt</span>

                            <?php else: ?>

                                <?php if (in_array($booking['status'], ['waiting_confirm', 'completed'])): ?>
                                    <span class="text-muted">—</span>
                                <?php else: ?>

                                    <!-- CÓ MẶT -->
                                    <form method="post" action="index.php?controller=guideCheckin&action=check"
                                        style="display:inline-block;">
                                        <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
                                        <input type="hidden" name="assignment_id" value="<?= $assignment_id ?>">
                                        <input type="hidden" name="customer_id" value="<?= $c['id'] ?>">
                                        <input type="hidden" name="check_date" value="<?= $date ?>">
                                        <input type="hidden" name="session" value="<?= $s ?>">
                                        <input type="hidden" name="status" value="present">

                                        <button class="btn btn-success btn-sm" title="Có mặt">✔</button>
                                    </form>

                                    <!-- VẮNG MẶT -->
                                    <form method="post" action="index.php?controller=guideCheckin&action=check"
                                        style="display:inline-block;">
                                        <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
                                        <input type="hidden" name="assignment_id" value="<?= $assignment_id ?>">
                                        <input type="hidden" name="customer_id" value="<?= $c['id'] ?>">
                                        <input type="hidden" name="check_date" value="<?= $date ?>">
                                        <input type="hidden" name="session" value="<?= $s ?>">
                                        <input type="hidden" name="status" value="absent">

                                        <button class="btn btn-danger btn-sm" title="Vắng mặt">✖</button>
                                    </form>

                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>

<?php if (!in_array($booking['status'], ['waiting_confirm', 'completed'])): ?>
    <form method="post" action="index.php?controller=guideCheckin&action=completeTrip">
        <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
        <button class="btn btn-primary mt-3">
            Hoàn thành chuyến đi
        </button>
    </form>
<?php endif; ?>