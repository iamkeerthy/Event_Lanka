<?php
require_once 'Database.php';
class Feedback {
    private $conn;
    private $table_name = "feedback";
    public $feedbackId;
    public $rating;
    public $comments;
    public $userId;
    public $eventId;
    public function __construct($db) {
        $this->conn = $db;
    }
     // Method to submit feedback
    public function submit() {
        $query = "INSERT INTO " . $this->table_name . " (rating, comments, userId, eventId) VALUES (:rating, :comments, :userId, :eventId)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comments', $this->comments);
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':eventId', $this->eventId);

        return $stmt->execute();
    }}
?>
