<?php
require_once 'Database.php';
class Event {
    private $conn;
    private $table_name = "event";
    public $eventId;
    public $eventName;
    public $eventType;
    public $eventDescription;
    public $eventDate;
    public $eventVenue;
    public $noOfGuests;
        public $adminId;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (eventName, eventType, eventDescription, eventDate, eventVenue, noOfGuests, adminId) VALUES (:eventName, :eventType, :eventDescription, :eventDate, :eventVenue, :noOfGuests, :adminId)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':eventName', $this->eventName);
        $stmt->bindParam(':eventType', $this->eventType);
        $stmt->bindParam(':eventDescription', $this->eventDescription);
        $stmt->bindParam(':eventDate', $this->eventDate);
        $stmt->bindParam(':eventVenue', $this->eventVenue);
        $stmt->bindParam(':noOfGuests', $this->noOfGuests);
        $stmt->bindParam(':adminId', $this->adminId);
        return $stmt->execute();
    }
}
?>
