<h2 class="fw-bold mb-4">Thống kê tổng quan</h2>

<!-- ====================== -->
<!--        CSS STYLE       -->
<!-- ====================== -->
<style>
    /* ===== CARD THỐNG KÊ ===== */
    .stat-card {
        border-radius: 14px;
        padding: 25px;
        color: #fff;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .stat-icon {
        font-size: 48px;
        opacity: 0.9;
    }

    /* ===== BẢNG ===== */
    .table-wrapper {
        background: #ffffff;
        padding: 0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.1);
    }

    /* Header bảng gradient */
    .table thead tr {
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        color: white;
        font-weight: 600;
        height: 55px;
    }

    .table th {
        border: none !important;
        font-size: 15px;
        padding-left: 20px;
    }

    /* Body bảng */
    .table tbody tr {
        height: 58px;
        vertical-align: middle;
        transition: background 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f5f7ff;
    }

    .table td {
        border: none !important;
        border-bottom: 1px solid #eee !important;
        padding-left: 20px;
        font-size: 15px;
    }

    /* Badge */
    .status-badge {
        background: #ffcc00;
        color: #000;
        padding: 8px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .status-success {
        background: #28d67e;
        color: #fff;
        padding: 8px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }
</style>


<!-- ====================== -->
<!--    THỐNG KÊ TỔNG QUAN  -->
<!-- ====================== -->
<div class="row g-4">

    <div class="col-md-3">
        <div class="stat-card bg-primary">
            <div>
                <h4>Tổng số tour</h4>
                <h2><?= $totalTours ?></h2>
            </div>
            <i class="bi bi-map stat-icon"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card bg-success">
            <div>
                <h4>Tổng booking</h4>
                <h2><?= $totalBookings ?></h2>
            </div>
            <i class="bi bi-calendar-check stat-icon"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card bg-warning text-dark">
            <div>
                <h4>Booking đang diễn ra</h4>
                <h2><?= $runningBookings ?></h2>
            </div>
            <i class="bi bi-hourglass-split stat-icon text-dark"></i>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card bg-info text-dark">
            <div>
                <h4>Booking hoàn thành</h4>
                <h2><?= $completedBookings ?></h2>
            </div>
            <i class="bi bi-check2-circle stat-icon text-dark"></i>
        </div>
    </div>

</div>


<!-- ====================== -->
<!--      TỔNG THU NHẬP     -->
<!-- ====================== -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="stat-card bg-dark text-white">
            <div>
                <h4>Tổng thu nhập</h4>
                <h2><?= number_format($income, 0, ',', '.') ?> VND</h2>
            </div>
            <i class="bi bi-cash-coin stat-icon"></i>
        </div>
    </div>
</div>


<!-- ====================== -->
<!--   BOOKING ĐANG DIỄN RA -->
<!-- ====================== -->
<h3 class="fw-bold mt-5 mb-3">Các booking đang diễn ra</h3>

<div class="table-wrapper">

    <table class="table mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tour</th>
                <th>Khách</th>
                <th>Ngày khởi hành</th>
                <th>Trạng thái</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($runningList)): ?>
                <tr>
                    <td colspan="5" class="text-center py-4">Không có booking nào đang diễn ra</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($runningList as $b): ?>
                <tr>
                    <td><?= $b['id'] ?></td>
                    <td><?= htmlspecialchars($b['tour_name']) ?></td>
                    <td><?= $b['num_people'] ?></td>
                    <td><?= $b['start_date'] ?></td>
                    <td>
                        <span class="status-badge">Đang diễn ra</span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>



<!-- ====================== -->
<!--  TOUR HOÀN THÀNH GẦN ĐÂY -->
<!-- ====================== -->
<h3 class="fw-bold mt-5 mb-3">Các tour đã hoàn thành gần đây</h3>

<div class="table-wrapper">

    <table class="table mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tour</th>
                <th>Khách</th>
                <th>Ngày khởi hành</th>
                <th>Trạng thái</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($recentCompleted)): ?>
                <tr>
                    <td colspan="5" class="text-center py-4">Chưa có tour hoàn thành</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($recentCompleted as $b): ?>
                <tr>
                    <td><?= $b['id'] ?></td>
                    <td><?= htmlspecialchars($b['tour_name']) ?></td>
                    <td><?= $b['num_people'] ?></td>
                    <td><?= $b['start_date'] ?></td>
                    <td>
                        <span class="status-success">Hoàn thành</span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>