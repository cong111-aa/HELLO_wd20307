<?php
class BookingPayment extends Model
{
    protected $table = "booking_payments";

    public function getByBooking($booking_id)
    {
        $stmt = $this->db->prepare("
            SELECT * 
            FROM booking_payments 
            WHERE booking_id = ? 
            ORDER BY payment_date ASC
        ");
        $stmt->execute([$booking_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalPaid($booking_id)
    {
        $stmt = $this->db->prepare("
            SELECT SUM(amount) 
            FROM booking_payments 
            WHERE booking_id = ?
        ");
        $stmt->execute([$booking_id]);
        return $stmt->fetchColumn() ?? 0;
    }

    public function create($data)
    {
        $sql = "INSERT INTO booking_payments 
                (booking_id, amount, payment_date, note, invoice_image, created_by, created_by_name)
                VALUES 
                (:booking_id, :amount, :payment_date, :note, :invoice_image, :created_by, :created_by_name)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
