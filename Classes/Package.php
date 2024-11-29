<?php
class Package {
    protected $conn;
    protected $table_name = "packages";

    public $packageName;
    public $packageDetails;
    public $packagePrice;
    public $packageImage; // Assuming you're adding this
    public $adminId; // Admin ID is required

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to add a package
    public function addPackage() {
        $query = "INSERT INTO `packages` (packageName, packageDetails, packagePrice, packageImage, adminId) VALUES (:packageName, :packageDetails, :packagePrice, :packageImage, :adminId)";
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':packageName', $this->packageName);
        $stmt->bindParam(':packageDetails', $this->packageDetails);
        $stmt->bindParam(':packagePrice', $this->packagePrice);
        $stmt->bindParam(':packageImage', $this->packageImage);
        $stmt->bindParam(':adminId', $this->adminId);
    
        // Execute and check for errors
        if (!$stmt->execute()) {
            throw new Exception("Failed to add package: " . implode(", ", $stmt->errorInfo()));
        }
    
        return true; // Return true if package added successfully
    }

    // Method to update an existing package
    public function updatePackage($packageId) {
        $query = "UPDATE `packages` SET packageDetails = :packageDetails, packagePrice = :packagePrice WHERE packageId = :packageId";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':packageDetails', $this->packageDetails);
        $stmt->bindParam(':packagePrice', $this->packagePrice);
        $stmt->bindParam(':packageId', $packageId);

        // Execute and check for errors
        if (!$stmt->execute()) {
            throw new Exception("Failed to update package: " . implode(", ", $stmt->errorInfo()));
        }

        return true; // Return true if package updated successfully
    }

    // Method to fetch all packages
    public function fetchAllPackages() {
        $query = "SELECT packageId, packageName FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
