<?php
require_once 'Database.php';

class Payment {
    private $conn;
    private $table_name = "payment";

    public $paymentId;
    public $paymentDate;
    public $paymentMethod;
    public $userId;
    public $packageId;
    public $amount;
    public $advanceAmount;
    public $dueAmount;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to make a payment
    public function makePayment() {
        $query = "INSERT INTO " . $this->table_name . " (paymentDate, paymentMethod, userId, packageId, amount, advanceAmount, dueAmount) 
                  VALUES (:paymentDate, :paymentMethod, :userId, :packageId, :amount, :advanceAmount, :dueAmount)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':paymentDate', $this->paymentDate);
        $stmt->bindParam(':paymentMethod', $this->paymentMethod);
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':packageId', $this->packageId);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':advanceAmount', $this->advanceAmount);
        $stmt->bindParam(':dueAmount', $this->dueAmount);

        return $stmt->execute();
    }

    // Method to retrieve payment details by user
    public function getPaymentsByUser($userId) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':userId', $userId);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to retrieve all payments
    public function getAllPayments() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to update payment (for example, updating dueAmount)
    public function updatePayment() {
        $query = "UPDATE " . $this->table_name . " 
                  SET paymentMethod = :paymentMethod, amount = :amount, advanceAmount = :advanceAmount, dueAmount = :dueAmount 
                  WHERE paymentId = :paymentId";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':paymentId', $this->paymentId);
        $stmt->bindParam(':paymentMethod', $this->paymentMethod);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':advanceAmount', $this->advanceAmount);
        $stmt->bindParam(':dueAmount', $this->dueAmount);

        return $stmt->execute();
    }
}
?>
