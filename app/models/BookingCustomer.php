<?php
class BookingCustomer extends Model
{
    protected $table = 'booking_customers';

    public function getByBooking($booking_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM booking_customers WHERE booking_id = ?");
        $stmt->execute([$booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO booking_customers (booking_id, full_name, phone, cccd, email)
                VALUES (:booking_id, :full_name, :phone, :cccd, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }
}
