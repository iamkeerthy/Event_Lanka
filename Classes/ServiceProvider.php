<!-- // this is Child Class -->

<?php
require_once 'User.php';

class ServiceProvider extends User {
    protected $table_name = "serviceprovider";

    public $providerId;
    public $providerName;
    public $contactInfo;
    public $serviceDetails;

    // Registering a new service provider
    public function register() {
        parent::register();

        $query = "INSERT INTO " . $this->table_name . " (userId, providerName, contactInfo, serviceDetails) VALUES (:userId, :providerName, :contactInfo, :serviceDetails)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':providerName', $this->providerName);
        $stmt->bindParam(':contactInfo', $this->contactInfo);
        $stmt->bindParam(':serviceDetails', $this->serviceDetails);

        return $stmt->execute();
    }
}
?>
