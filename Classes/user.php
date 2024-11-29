<?php
require_once 'Database.php';

class User {
    protected $conn;
    protected $table_name = "user";

    public $userId;
    public $username; 
    public $password;
    public $email;
    public $userType;
    public $profilePicture; 

    public function __construct($db) {
        $this->conn = $db;
    }

    // Check if user exists by username or email
    public function userExists($username, $email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Return true if any row exists, meaning user already exists
        return $stmt->rowCount() > 0;
    }

    // Register a new user
    public function register() {
        // Check for duplicate username or email
        if ($this->userExists($this->username, $this->email)) {
            throw new Exception("Username or email already exists.");
        }

        $query = "INSERT INTO " . $this->table_name . " (username, password, email, userType) VALUES (:username, :password, :email, :userType)";
        $stmt = $this->conn->prepare($query);

        // Sanitize input and hash password
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT); // Hashing the password
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->userType = htmlspecialchars(strip_tags($this->userType));

        // Bind parameters
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':userType', $this->userType);

        // Execute and check for errors
        if (!$stmt->execute()) {
            throw new Exception("Failed to register user: " . implode(", ", $stmt->errorInfo()));
        }

        $this->userId = $this->conn->lastInsertId(); // Get the last inserted ID
        return true;
    }

    // Login user
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify the hashed password
            if (password_verify($password, $row['password'])) { 
                $this->userId = $row['userId'];
                $this->username = $row['username'];
                $this->userType = $row['userType'];
                return true;
            }
        }
        return false; 
    }

    // Get adminId based on userId
    public function getAdminId() {
        // Assuming your admin table has a foreign key relationship with user table
        $query = "SELECT adminId FROM admin WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $this->userId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['adminId'] : null; // Return adminId or null if not found
    }

    // Update user information
    public function updateUser() {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind parameters
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':userId', $this->userId);

        // Execute and check for errors
        if (!$stmt->execute()) {
            throw new Exception("Failed to update user information: " . implode(", ", $stmt->errorInfo()));
        }

        return true;
    }

    // Update profile picture
    public function updateProfilePicture() {
        $query = "UPDATE " . $this->table_name . " SET profilePicture = :profilePicture WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->profilePicture = htmlspecialchars(strip_tags($this->profilePicture));

        // Bind parameters
        $stmt->bindParam(':profilePicture', $this->profilePicture);
        $stmt->bindParam(':userId', $this->userId);

        // Execute and check for errors
        if (!$stmt->execute()) {
            throw new Exception("Failed to update profile picture: " . implode(", ", $stmt->errorInfo()));
        }

        return true;
    }

    // Fetch user data by ID
    public function fetchUserData($userId) {
        $query = "SELECT username, email, profilePicture FROM " . $this->table_name . " WHERE userId = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch and return user data
    }
}
?>
