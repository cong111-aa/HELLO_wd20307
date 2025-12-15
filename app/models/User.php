<?php
class User extends Model
{
    protected $table = 'users';

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getGuides()
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'guide'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (name, email, password_hash, role)
                VALUES (:name, :email, :password_hash, :role)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateGuide($id, $data)
    {
        $sql = "UPDATE users SET 
                name = :name,
                email = :email,
                password_hash = :password_hash
                WHERE id = :id";

        $data['id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAdmins()
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'admin'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
