<?php
class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);
            if ($user && $password === $user['password_hash']) {

                $_SESSION['user'] = $user;
                if ($user['role'] === 'admin') {
                    $this->redirect('index.php?controller=adminTour&action=index');
                } else {
                    $this->redirect('index.php?controller=guide&action=dashboard');
                }
            } else {
                $error = 'Sai email hoặc mật khẩu';
                $this->render('auth/login', compact('error'));
                return;
            }
        } else {
            $this->render('auth/login');
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('index.php?controller=auth&action=login');
    }
}
| Thành phần         | Vai trò                     |
| ------------------ | --------------------------- |
| **AuthController** | Xử lý đăng nhập, đăng xuất  |
| **User Model**     | Truy vấn dữ liệu người dùng |
| **Session**        | Lưu trạng thái đăng nhập    |
| **View**           | Hiển thị form login         |
| **Router**         | Điều hướng theo role        |

START
  ↓
User truy cập /login
  ↓
POST?
 ├─ NO → Hiển thị form
 └─ YES
     ↓
  Kiểm tra email
     ↓
  So sánh mật khẩu
     ↓
 ├─ Sai → Hiển thị lỗi
 └─ Đúng
     ↓
  Lưu session
     ↓
  Phân quyền
     ↓
  Redirect
Người dùng → Mở trang login
          → Nhập email + mật khẩu
          → Submit form (POST)
          → Controller xác thực
          → Lưu session
          → Điều hướng theo role
