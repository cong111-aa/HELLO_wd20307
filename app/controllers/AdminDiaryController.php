<?php
class AdminDiaryController extends Controller
{
    // Danh sách assignment để admin chọn xem nhật ký
    public function assignmentList()
    {
        $assignmentModel = new TourAssignment();
        $assignments = $assignmentModel->getAllForDiary();

        $this->render(
            'admin/diaries/assignment_list',
            compact('assignments')
        );
    }

    // Xem nhật ký của 1 assignment
    public function history()
    {
        $assignment_id = $_GET['assignment_id'] ?? null;
        if (!$assignment_id)
            die('Thiếu assignment_id');

        $diaries = (new TourDiary())->getByAssignment($assignment_id);

        $this->render(
            'admin/diaries/history',
            compact('diaries', 'assignment_id')
        );
    }
}
Admin
 ↓
Chọn "Quản lý nhật ký tour"
 ↓
assignmentList()
 ↓
Hiển thị danh sách assignment
 ↓
Admin chọn 1 assignment
 ↓
history()?assignment_id=...
 ↓
Lấy nhật ký tour theo assignment
 ↓
Hiển thị danh sách nhật ký
