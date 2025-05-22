<?php
// classes/User.php

class User {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new user
    public function register($username, $plainPassword) {
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        // Generate a random 16-byte AES key and store it
        $aesKey = base64_encode(random_bytes(16));

        $stmt = $this->conn->prepare("INSERT INTO users (username, password, aes_key) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $aesKey);
        return $stmt->execute();
    }

    // Login an existing user
    public function login($username, $plainPassword) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($plainPassword, $row['password'])) {
                return $row; // success!
            }
        }

        return false;
    }
}
?>
