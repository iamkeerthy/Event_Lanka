<?php
require_once 'Database.php';

class EventBooking {
    private $conn;
    private $table_name = "usereventbooking";

    public $bookingId;
    public $userId;
    public $eventId;
    public $bookingDate;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to book an event
    public function bookEvent() {
        $query = "INSERT INTO " . $this->table_name . " (userId, eventId, bookingDate) VALUES (:userId, :eventId, :bookingDate)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':eventId', $this->eventId);
        $stmt->bindParam(':bookingDate', $this->bookingDate);

        if ($stmt->execute()) {
            $this->bookingId = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Method to retrieve all bookings by a user
    public function getBookingsByUser($userId) {
        $query = "SELECT e.eventId, e.eventName, e.eventDate, e.eventVenue 
                  FROM " . $this->table_name . " eb
                  JOIN event e ON eb.eventId = e.eventId
                  WHERE eb.userId = :userId";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':userId', $userId);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to retrieve all users who booked a specific event
    public function getUsersForEvent($eventId) {
        $query = "SELECT u.userId, u.userName, u.email 
                  FROM " . $this->table_name . " eb
                  JOIN user u ON eb.userId = u.userId
                  WHERE eb.eventId = :eventId";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        
        $stmt->bindParam(':eventId', $eventId);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cancel an event booking
    public function cancelBooking() {
        $query = "DELETE FROM " . $this->table_name . " WHERE bookingId = :bookingId";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':bookingId', $this->bookingId);

        return $stmt->execute();
    }
}
?>
