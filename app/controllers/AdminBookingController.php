<?php
class AdminBookingController extends Controller
{
    private $bookingModel;
    private $tourModel;

    public function __construct()
    {
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->redirect('index.php?controller=auth&action=login');
        }
        $this->bookingModel = new Booking();
        $this->tourModel = new Tour();
    }

    public function index()
    {
        $bookings = $this->bookingModel->all();
        $this->render('admin/bookings/index', compact('bookings'));
    }

    public function create()
    {
        $partnerModel = new Partner();
        $hotels = $partnerModel->allHotels();
        $transports = $partnerModel->allTransports();
        $tours = $this->tourModel->all();

        $userModel = new User();
        $guides = $userModel->getGuides();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tour_id' => $_POST['tour_id'],
                'customer_name' => $_POST['customer_name'],
                'customer_phone' => $_POST['customer_phone'],
                'customer_email' => $_POST['customer_email'],
                'num_people' => $_POST['num_people'],
                'deposit_amount' => $_POST['deposit_amount'] ?? 0,
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'booking_type' => $_POST['booking_type'],
                'special_requests' => $_POST['special_requests'],
                'status' => 'pending',
                'hotel_id' => $_POST['hotel_id'],
                'transport_id' => $_POST['transport_id'],
            ];



            // tạo booking
            $bookingId = $this->bookingModel->createAndReturnId($data);

            // lưu phân công HDV (không kiểm tra trùng lịch nữa)
            $assignModel = new TourAssignment();
            $assignModel->assignGuide(
                $_POST['tour_id'],
                $_POST['guide_id'],
                $bookingId,
                $_POST['start_date']
            );

            $this->redirect('index.php?controller=adminBooking&action=index');
        }

        $this->render('admin/bookings/create', compact('tours', 'guides', 'hotels', 'transports'));
    }


    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('index.php?controller=adminBooking&action=index');
        }

        // Lấy thông tin booking
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            $this->redirect('index.php?controller=adminBooking&action=index');
        }

        // Lịch trình tour
        $tourModel = new Tour();
        $schedule = $tourModel->getSchedule($booking['tour_id']);

        // Lịch sử thanh toán
        $paymentModel = new BookingPayment();     // nhớ đã có model này
        $payments = $paymentModel->getByBooking($id);
        $totalPaid = $paymentModel->totalPaid($id);

        // Truyền hết sang view
        $this->render(
            'admin/bookings/show',
            compact('booking', 'schedule', 'payments', 'totalPaid')
        );
    }



    public function updateStatus()
    {
        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;

        if ($id && $status) {
            $this->bookingModel->updateStatus($id, $status);
        }

        $this->redirect('index.php?controller=adminBooking&action=index');
    }


    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            $this->redirect("index.php?controller=adminBooking&action=index");

        $booking = $this->bookingModel->find($id);

        $tours = (new Tour())->all();
        $guides = (new User())->getGuides();
        $partners = new Partner();
        $hotels = $partners->allHotels();
        $transports = $partners->allTransports();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // cập nhật booking (không kiểm tra trùng lịch nữa)
            $data = [
                'tour_id' => $_POST['tour_id'],
                'customer_name' => $_POST['customer_name'],
                'customer_phone' => $_POST['customer_phone'],
                'customer_email' => $_POST['customer_email'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'booking_type' => $_POST['booking_type'],
                'num_people' => $_POST['num_people'],
                'deposit_amount' => $_POST['deposit_amount'],

                'special_requests' => $_POST['special_requests'],
                'status' => $_POST['status'],
                'hotel_id' => $_POST['hotel_id'],
                'transport_id' => $_POST['transport_id']
            ];

            $this->bookingModel->update($id, $data);

            // cập nhật HDV
            $assign = new TourAssignment();
            $assign->updateGuide($id, $_POST['guide_id']);

            $this->redirect("index.php?controller=adminBooking&action=index");
        }

        $this->render('admin/bookings/edit', compact('booking', 'tours', 'guides', 'hotels', 'transports'));
    }


    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id)
            $this->bookingModel->delete($id);

        $this->redirect("index.php?controller=adminBooking&action=index");
    }
    public function getToursByType()
    {
        $type = $_GET['type'] ?? null;

        if (!$type) {
            echo json_encode([]);
            return;
        }

        $tours = $this->tourModel->getByType($type);
        echo json_encode($tours);
    }

}
