<?php
class GuideAdminController extends Controller
{
    private $userModel;

    public function __construct()
    {
        // Chỉ cho phép Admin truy cập
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->redirect('index.php?controller=auth&action=login');
        }

        $this->userModel = new User();
    }

    // HIỂN THỊ DANH SÁCH CHUNG (Admin + Hướng dẫn viên)
    public function index()
    {
        $guides = $this->userModel->getGuides();
        $admins = $this->userModel->getAdmins();

        // Gộp danh sách Admin + HDV thành 1 bảng
        $employees = array_merge($guides, $admins);

        $this->render('admin/guides/index', compact('employees'));
    }

    // THÊM HƯỚNG DẪN VIÊN
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                // Không mã hóa mật khẩu theo yêu cầu trước đó
                'password_hash' => $_POST['password'],
                'role' => 'guide'
            ];

            $this->userModel->create($data);

            $this->redirect('index.php?controller=guideAdmin&action=index');
        }

        $this->render('admin/guides/create');
    }

    // SỬA THÔNG TIN HƯỚNG DẪN VIÊN
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            $this->redirect('index.php?controller=guideAdmin&action=index');

        $employee = $this->userModel->find($id);

        // Không cho sửa Admin
        if ($employee['role'] === 'admin') {
            $this->redirect('index.php?controller=guideAdmin&action=index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password_hash' => $_POST['password']
            ];

            $this->userModel->updateGuide($id, $data);

            $this->redirect('index.php?controller=guideAdmin&action=index');
        }

        $this->render('admin/guides/edit', compact('employee'));
    }

    // XÓA HƯỚNG DẪN VIÊN
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $user = $this->userModel->find($id);

            // Chỉ cho phép xóa HDV, không xóa Admin
            if ($user['role'] === 'guide') {
                $this->userModel->delete($id);
            }
        }

        $this->redirect('index.php?controller=guideAdmin&action=index');
    }
}
