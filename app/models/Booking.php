<?php
class Booking extends Model
{
    protected $table = 'bookings';

    public function all()
    {
        $sql = "SELECT 
                b.*, 
                t.name AS tour_name,
                t.base_price AS base_price
            FROM {$this->table} b
            JOIN tours t ON b.tour_id = t.id
            ORDER BY b.id DESC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function find($id)
    {
        $sql = "SELECT 
                b.*,
                t.name AS tour_name,
                t.base_price AS base_price,

                u.name AS guide_name,
                u.email AS guide_email,
                ta.start_date AS guide_start,
                ta.end_date AS guide_end,

                h.name AS hotel_name,
                tr.name AS transport_name

            FROM bookings b
            JOIN tours t ON b.tour_id = t.id

            LEFT JOIN tour_assignments ta ON ta.booking_id = b.id
            LEFT JOIN users u ON ta.guide_id = u.id

            LEFT JOIN partners h ON b.hotel_id = h.id AND h.type='hotel'
            LEFT JOIN partners tr ON b.transport_id = tr.id AND tr.type='transport'

            WHERE b.id = ?
            LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createAndReturnId($data)
    {
        $sql = "INSERT INTO bookings
        (tour_id, customer_name, customer_phone, customer_email,
         num_people, deposit_amount, start_date, end_date,
         booking_type, special_requests, status, hotel_id, transport_id)
        VALUES
        (:tour_id, :customer_name, :customer_phone, :customer_email,
         :num_people, :deposit_amount, :start_date, :end_date,
         :booking_type, :special_requests, :status, :hotel_id, :transport_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return $this->db->lastInsertId();
    }


    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE bookings SET
 tour_id = :tour_id,
 customer_name = :customer_name,
 customer_phone = :customer_phone,
 customer_email = :customer_email,
 num_people = :num_people,
 deposit_amount = :deposit_amount,
 start_date = :start_date,
 end_date = :end_date,
 booking_type = :booking_type,
 special_requests = :special_requests,
 status = :status,
 hotel_id = :hotel_id,
 transport_id = :transport_id
 WHERE id = :id";


        $data['id'] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        // Xóa phân công hướng dẫn viên
        $stmt = $this->db->prepare("DELETE FROM tour_assignments WHERE booking_id = ?");
        $stmt->execute([$id]);

        // Xóa booking
        $stmt = $this->db->prepare("DELETE FROM bookings WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Dashboard functions
    public function countBookings()
    {
        return $this->db->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
    }

    public function countCompleted()
    {
        return $this->db->query("SELECT COUNT(*) FROM bookings WHERE status = 'completed'")->fetchColumn();
    }

    public function countRunning()
    {
        return $this->db->query("
            SELECT COUNT(*) 
            FROM bookings 
            WHERE status NOT IN ('completed', 'canceled')
        ")->fetchColumn();
    }

    public function calculateIncome()
    {
        return $this->db->query("
            SELECT SUM(base_price * 1) 
            FROM bookings 
            JOIN tours ON tours.id = bookings.tour_id
            WHERE bookings.status = 'completed'
        ")->fetchColumn() ?? 0;
    }

    public function runningList()
    {
        $sql = "SELECT b.*, t.name AS tour_name
                FROM bookings b
                JOIN tours t ON t.id = b.tour_id
                WHERE b.status NOT IN ('completed','canceled')
                ORDER BY b.start_date ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recentCompleted($limit = 5)
    {
        $sql = "SELECT b.*, t.name AS tour_name
                FROM bookings b
                JOIN tours t ON t.id = b.tour_id
                WHERE b.status = 'completed'
                ORDER BY b.start_date DESC
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
