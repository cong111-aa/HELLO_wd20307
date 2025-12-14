<?php
class Notification extends Model
{
    protected $table = 'notifications';

    public function create($data)
    {
        $sql = "INSERT INTO notifications (title, content)
VALUES (:title, :content)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
?>