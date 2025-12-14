<?php
class Checkin extends Model
{
    protected $table = "checkins";

    /**
     * ================================
     * ADMIN: Xem toàn bộ lịch sử điểm danh theo booking
     * ================================
     */
    public function getByBooking($booking_id)
    {
        $sql = "
            SELECT 
                c.check_date,
                c.session,
                c.status,
                c.checkin_time,
                bc.full_name,
                u.name AS creator_name
            FROM checkins c
            JOIN booking_customers bc ON bc.id = c.customer_id
            LEFT JOIN users u ON u.id = c.created_by
            WHERE c.booking_id = ?
            ORDER BY c.check_date ASC, c.session ASC, c.checkin_time ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * ================================
     * GUIDE: Lấy trạng thái điểm danh
     * (1 khách – 1 ngày – 1 buổi)
     * ================================
     */
    public function getStatus($booking_id, $customer_id, $check_date, $session)
    {
        $stmt = $this->db->prepare("
            SELECT status
            FROM checkins
            WHERE booking_id = ?
              AND customer_id = ?
              AND check_date = ?
              AND session = ?
            LIMIT 1
        ");

        $stmt->execute([
            $booking_id,
            $customer_id,
            $check_date,
            $session
        ]);

        return $stmt->fetchColumn() ?: null;
    }

    /**
     * ================================
     * GUIDE: Tạo hoặc cập nhật điểm danh
     * (Mỗi khách – mỗi ngày – mỗi buổi chỉ có 1 bản ghi)
     * ================================
     */
    public function createOrUpdateCheckin(
        $booking_id,
        $assignment_id,
        $customer_id,
        $check_date,
        $session,
        $status,
        $user_id
    ) {
        // Lấy ngày bắt đầu tour
        $stmt = $this->db->prepare("
        SELECT start_date FROM bookings WHERE id = ?
    ");
        $stmt->execute([$booking_id]);
        $start_date = $stmt->fetchColumn();

        if (!$start_date) {
            throw new Exception('Không tìm thấy booking');
        }

        // Tính day_number
        $day_number =
            (strtotime($check_date) - strtotime($start_date)) / 86400 + 1;

        // Kiểm tra tồn tại
        $stmt = $this->db->prepare("
        SELECT id FROM checkins
        WHERE booking_id = ?
          AND customer_id = ?
          AND check_date = ?
          AND session = ?
    ");
        $stmt->execute([$booking_id, $customer_id, $check_date, $session]);
        $id = $stmt->fetchColumn();

        if ($id) {
            // Update
            $stmt = $this->db->prepare("
            UPDATE checkins
            SET status = ?, created_by = ?, checkin_time = NOW()
            WHERE id = ?
        ");
            return $stmt->execute([$status, $user_id, $id]);
        }

        // Insert mới (⚠️ CÓ day_number)
        $stmt = $this->db->prepare("
        INSERT INTO checkins
        (booking_id, assignment_id, customer_id, check_date, day_number,
         session, status, created_by, checkin_time)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");

        return $stmt->execute([
            $booking_id,
            $assignment_id,
            $customer_id,
            $check_date,
            $day_number,
            $session,
            $status,
            $user_id
        ]);
    }


    /**
     * ================================
     * GUIDE: Đếm số NGÀY đã điểm danh ĐỦ 3 BUỔI
     * (Dùng để kiểm tra hoàn thành chuyến đi)
     * ================================
     */
    public function countCompletedDays($booking_id)
    {
        $sql = "
            SELECT COUNT(*) FROM (
                SELECT check_date
                FROM checkins
                WHERE booking_id = ?
                GROUP BY check_date
                HAVING COUNT(DISTINCT session) = 3
            ) AS completed_days
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$booking_id]);
        return (int) $stmt->fetchColumn();
    }

    /**
     * ================================
     * ADMIN: Lịch sử điểm danh (gộp đẹp)
     * ================================
     */
    public function getHistoryForAdmin($booking_id)
    {
        $sql = "
            SELECT 
                c.check_date,
                c.session,
                c.status,
                c.checkin_time,
                bc.full_name,
                u.name AS creator_name
            FROM checkins c
            JOIN booking_customers bc ON bc.id = c.customer_id
            LEFT JOIN users u ON u.id = c.created_by
            WHERE c.booking_id = ?
            ORDER BY c.check_date DESC, c.session ASC, c.checkin_time DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
