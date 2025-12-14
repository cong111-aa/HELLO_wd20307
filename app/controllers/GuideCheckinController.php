<?php
class GuideCheckinController extends Controller
{
    public function index()
    {
        $booking_id = $_GET['booking_id'] ?? null;
        $assignment_id = $_GET['assignment_id'] ?? null;

        if (!$booking_id) {
            $this->redirect('index.php?controller=guide&action=dashboard');
        }

        $bookingModel = new Booking();
        $booking = $bookingModel->find($booking_id);

        if (!$booking) {
            die('Booking không tồn tại');
        }

        // ❌ Không cho check-in khi đã gửi xác nhận hoặc hoàn thành
        if (in_array($booking['status'], ['waiting_confirm', 'completed'])) {
            $readonly = true;
        } else {
            $readonly = false;
        }

        // Lấy khách
        $customers = (new BookingCustomer())->getByBooking($booking_id);

        // Tính ngày
        $start = new DateTime($booking['start_date']);
        $end = new DateTime($booking['end_date']);
        $end->modify('+1 day');

        $days = [];
        for ($d = clone $start; $d < $end; $d->modify('+1 day')) {
            $days[] = $d->format('Y-m-d');
        }

        $sessions = ['morning', 'afternoon', 'evening'];

        $checkinModel = new Checkin();
        $checked = [];

        foreach ($customers as $c) {
            foreach ($days as $date) {
                foreach ($sessions as $session) {
                    $checked[$c['id']][$date][$session] =
                        $checkinModel->getStatus(
                            $booking_id,
                            $c['id'],
                            $date,
                            $session
                        );
                }
            }
        }

        $this->render(
            "guide/checkin/index",
            compact(
                "booking",
                "customers",
                "booking_id",
                "assignment_id",
                "days",
                "sessions",
                "checked",
                "readonly"
            )
        );
    }

    public function check()
    {
        if (empty($_SESSION['user'])) {
            die('Bạn chưa đăng nhập');
        }

        $booking_id = $_POST['booking_id'];
        $assignment_id = $_POST['assignment_id'] ?? null;
        $customer_id = $_POST['customer_id'];
        $check_date = $_POST['check_date'];
        $session = $_POST['session'];
        $status = $_POST['status'];
        $user_id = $_SESSION['user']['id'];

        $booking = (new Booking())->find($booking_id);

        // ❌ Không cho check nếu đã gửi xác nhận / hoàn thành
        if (in_array($booking['status'], ['waiting_confirm', 'completed'])) {
            die('Không thể điểm danh khi tour đã kết thúc');
        }

        (new Checkin())->createOrUpdateCheckin(
            $booking_id,
            $assignment_id,
            $customer_id,
            $check_date,
            $session,
            $status,
            $user_id
        );

        $this->redirect(
            "index.php?controller=guideCheckin&action=index&booking_id=$booking_id&assignment_id=$assignment_id"
        );
    }

    public function completeTrip()
    {
        if (empty($_SESSION['user'])) {
            die('Bạn chưa đăng nhập');
        }

        $booking_id = $_POST['booking_id'] ?? null;
        if (!$booking_id) {
            die('Thiếu booking_id');
        }

        $bookingModel = new Booking();
        $booking = $bookingModel->find($booking_id);

        if (!$booking) {
            die('Booking không tồn tại');
        }

        if (in_array($booking['status'], ['waiting_confirm', 'completed'])) {
            echo "<script>
                alert('Chuyến đi đã được gửi xác nhận hoặc đã hoàn thành.');
                window.location.href='index.php?controller=guide&action=dashboard';
            </script>";
            exit;
        }

        $checkinModel = new Checkin();

        $total_days =
            (strtotime($booking['end_date']) - strtotime($booking['start_date'])) / 86400 + 1;

        $checked_days = $checkinModel->countCompletedDays($booking_id);

        if ($checked_days < $total_days) {
            echo "<script>
                alert('Chưa điểm danh đủ số ngày!');
                history.back();
            </script>";
            exit;
        }

        // 👉 Chuyển trạng thái
        $bookingModel->update($booking_id, [
            'status' => 'waiting_confirm'
        ]);

        // 👉 Tạo thông báo admin
        (new Notification())->create([
            'type' => 'booking',
            'title' => 'Yêu cầu xác nhận hoàn thành tour',
            'content' =>
                'Tour "' . $booking['tour_name'] .
                '" (Booking #' . $booking_id .
                ') do HDV "' . $_SESSION['user']['name'] .
                '" đã hoàn thành.',
            'booking_id' => $booking_id
        ]);

        echo "<script>
            alert('Đã gửi yêu cầu hoàn thành chuyến đi.');
            window.location.href='index.php?controller=guide&action=dashboard';
        </script>";
    }
}
