<!-- // this is Child Class -->

<?php
require_once 'User.php';
class RegisteredUser extends User {
    protected $table_name = "registereduser";
    public $contactNumber;
    public $address;
    public $NICNumber;
    public $NICFrontPhoto;
    public $NICBackPhoto;

    // Registering a new registered user
    public function register() {
        parent::register(); 
        
        $query = "INSERT INTO " . $this->table_name . " (userId, contactNumber, address, NICNumber, NICFrontPhoto, NICBackPhoto) VALUES (:userId, :contactNumber, :address, :NICNumber, :NICFrontPhoto, :NICBackPhoto)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':contactNumber', $this->contactNumber);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':NICNumber', $this->NICNumber);
        $stmt->bindParam(':NICFrontPhoto', $this->NICFrontPhoto);
        $stmt->bindParam(':NICBackPhoto', $this->NICBackPhoto);

        return $stmt->execute();
    }}
?>
