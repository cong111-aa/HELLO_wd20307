<?php
class PartnerController extends Controller
{
    private $partner;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->redirect('index.php?controller=auth&action=login');
        }

        $this->partner = new Partner();
    }

    // ✅ Trang chính - chia theo loại & khu vực
    public function index()
    {
        $hotels = $this->partner->allByType('hotel');
        $transports = $this->partner->allByType('transport');

        $this->render('admin/partners/index', compact('hotels', 'transports'));
    }


    // ✅ Danh sách theo loại (nếu muốn dùng riêng)
    public function list()
    {
        $type = $_GET['type'] ?? 'hotel';
        $partners = $this->partner->allByType($type);

        $this->render('admin/partners/list', compact('partners', 'type'));
    }

    // ✅ Thêm đối tác (có sao + khu vực)
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'region' => $_POST['region'],
                'contact' => $_POST['contact'],
                'address' => $_POST['address'],
                'rating' => $_POST['rating']
            ];

            $this->partner->create($data);

            $this->redirect('index.php?controller=partner&action=index');
        }

        $this->render('admin/partners/create');
    }

    // ✅ Sửa đối tác
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            $this->redirect('index.php?controller=partner&action=index');

        $partner = $this->partner->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'region' => $_POST['region'],
                'contact' => $_POST['contact'],
                'address' => $_POST['address'],
                'rating' => $_POST['rating']
            ];

            $this->partner->updatePartner($id, $data);

            $this->redirect('index.php?controller=partner&action=index');
        }

        $this->render('admin/partners/edit', compact('partner'));
    }

    // ✅ Xóa đối tác
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->partner->delete($id);
        }

        $this->redirect('index.php?controller=partner&action=index');
    }
}
