<?php
class AdminCheckinController extends Controller
{
    /**
     * Danh sách booking để admin chọn xem điểm danh
     */
    public function bookingList()
    {
        $bookingModel = new Booking();
        $bookings = $bookingModel->all();

        $this->render("admin/checkins/booking_list", compact("bookings"));
    }

    /**
     * Lịch sử điểm danh theo ngày + buổi
     */
    public function history()
    {
        $booking_id = $_GET['booking_id'] ?? null;

        if (!$booking_id) {
            $this->redirect("index.php?controller=adminCheckin&action=bookingList");
        }

        $checkinModel = new Checkin();
        $history = $checkinModel->getHistoryForAdmin($booking_id);

        $this->render(
            "admin/checkins/history",
            compact("history", "booking_id")
        );
    }
}
