<?php
class AdminTourController extends Controller
{
    private $tourModel;

    public function __construct()
    {
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->redirect('index.php?controller=auth&action=login');
        }
        $this->tourModel = new Tour();
    }

    public function index()
    {
        $tours = $this->tourModel->all();

        $domestic = [];
        $international = [];
        $custom = [];

        foreach ($tours as $t) {
            if ($t['type'] === 'domestic') {
                $domestic[] = $t;
            } elseif ($t['type'] === 'international') {
                $international[] = $t;
            } elseif ($t['type'] === 'custom') {   // FIX CHÍNH TẠI ĐÂY
                $custom[] = $t;
            }
        }

        $this->render('admin/tours/index', [
            'domestic' => $domestic,
            'international' => $international,
            'custom' => $custom
        ]);
    }


    public function create()
    {
        $partnerModel = new Partner();
        $hotels = $partnerModel->allHotels();
        $transports = $partnerModel->allTransports();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'tour_schedule' => $_POST['tour_schedule'],
                'image' => $_POST['image'],
                'base_price' => $_POST['base_price'],
                'min_people' => $_POST['min_people'],
                'max_people' => $_POST['max_people'],
                'hotel_star' => $_POST['hotel_star'],
                'transport_star' => $_POST['transport_star'],

            ];

            $this->tourModel->create($data);
            $this->redirect('index.php?controller=adminTour&action=index');
        }

        $this->render('admin/tours/create', compact('hotels', 'transports'));
    }

    public function edit()
    {
        $partnerModel = new Partner();
        $hotels = $partnerModel->allHotels();
        $transports = $partnerModel->allTransports();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('index.php?controller=adminTour&action=index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'image' => $_POST['image'],
                'base_price' => $_POST['base_price'],
                'tour_schedule' => $_POST['tour_schedule'],
                'min_people' => $_POST['min_people'],
                'max_people' => $_POST['max_people'],
                'hotel_star' => $_POST['hotel_star'],
                'transport_star' => $_POST['transport_star'],

            ];



            $this->tourModel->updateTour($id, $data);
            $this->redirect('index.php?controller=adminTour&action=index');
        }

        $tour = $this->tourModel->find($id);

        $this->render('admin/tours/edit', compact('tour', 'hotels', 'transports'));
    }
      public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->redirect('index.php?controller=adminTour&action=index');
        }

        $tour = $this->tourModel->find($id);

        $partnerModel = new Partner();
        $hotel = $partnerModel->find($tour['hotel_id']);
        $transport = $partnerModel->find($tour['transport_id']);

        $this->render('admin/tours/show', compact('tour', 'hotel', 'transport'));
    }


    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->tourModel->delete($id);
        }
        $this->redirect('index.php?controller=adminTour&action=index');
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

