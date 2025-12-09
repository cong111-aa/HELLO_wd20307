<?php
class BookingCustomerController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new BookingCustomer();
    }

    // Trang danh sách khách hàng theo booking
    public function index()
    {
        $booking_id = $_GET['booking_id'];
        $customers = $this->model->getByBooking($booking_id);

        $this->render('admin/customers/index', compact('customers', 'booking_id'));
    }

    // Trang thêm khách
    public function create()
    {
        $booking_id = $_GET['booking_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'booking_id' => $booking_id,
                'full_name' => $_POST['full_name'],
                'phone' => $_POST['phone'],
                'cccd' => $_POST['cccd'],
                'email' => $_POST['email']
            ];

            $this->model->create($data);

            $this->redirect("index.php?controller=bookingCustomer&action=index&booking_id=$booking_id");
        }

        $this->render('admin/customers/create', compact('booking_id'));
    }
}
