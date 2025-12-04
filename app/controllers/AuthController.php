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
