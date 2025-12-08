<?php
class Tour extends Model
{
    protected $table = 'tours';

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO tours 
            (name, type, tour_schedule, image, base_price, min_people, max_people, hotel_star, transport_star)
            VALUES 
            (:name, :type, :tour_schedule, :image, :base_price, :min_people, :max_people, :hotel_star, :transport_star)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }


    public function updateTour($id, $data)
    {
        $sql = "UPDATE tours SET
    name = :name,
    type = :type,
    image = :image,
    base_price = :base_price,
    tour_schedule = :tour_schedule,
    min_people = :min_people,
    max_people = :max_people,
    hotel_star = :hotel_star,
    transport_star = :transport_star
WHERE id = :id";

        $data['id'] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }


    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function countTours()
    {
        return $this->db->query("SELECT COUNT(*) FROM tours")->fetchColumn();
    }
    public function getSchedule($tour_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tour_schedule WHERE tour_id = ? ORDER BY day_number ASC");
        $stmt->execute([$tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByType($type)
    {
        $stmt = $this->db->prepare("SELECT * FROM tours WHERE type = ?");
        $stmt->execute([$type]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
