<!-- // this is Child Class -->

<?php
require_once 'User.php';

class Admin extends User {
    protected $table_name = "admin";

    public $adminId;
    public $role = "Administrator";

    

    public function register() {
        parent::register();

        $query = "INSERT INTO " . $this->table_name . " (userId, role) VALUES (:userId, :role)";
        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':role', $this->role);

        return $stmt->execute();
    }
}
?>
