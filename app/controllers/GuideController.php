<?php
class GuideController extends Controller
{
    private $assignmentModel;
    private $diaryModel;

    public function __construct()
    {
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'guide') {
            $this->redirect('index.php?controller=auth&action=login');
        }
        $this->assignmentModel = new TourAssignment();
        $this->diaryModel = new TourDiary();
    }

    public function dashboard()
    {
        $guideId = $_SESSION['user']['id'];
        $assignments = $this->assignmentModel->getByGuide($guideId);
        $this->render('guide/dashboard', compact('assignments'));
    }

    public function diary()
    {
        $assignmentId = $_GET['assignment_id'] ?? null;
        if (!$assignmentId) {
            $this->redirect('index.php?controller=guide&action=dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'assignment_id' => $assignmentId,
                'date' => $_POST['date'],
                'highlight' => $_POST['highlight'],
                'issues' => $_POST['issues'],
                'solutions' => $_POST['solutions'],
                'customer_feedback' => $_POST['customer_feedback'],
                'photos' => $_POST['photos'] ?? ''
            ];
            $this->diaryModel->createDiary($data);
        }

        $diaries = $this->diaryModel->getByAssignment($assignmentId);
        $this->render('guide/diary', [
            'assignment_id' => $assignmentId,
            'diaries' => $diaries
        ]);
    }

    public function checkin()
    {
        $assignmentId = $_GET['assignment_id'] ?? null;
        if (!$assignmentId) {
            $this->redirect('index.php?controller=guide&action=dashboard');
        }

        // Ở đây bạn có thể load customers theo booking nếu muốn
        $this->render('guide/checkin', compact('assignmentId'));
    }
}
