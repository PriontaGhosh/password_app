<?php
// classes/PasswordManager.php

class PasswordManager {
    private $conn;
    private $aesKey;

    public function __construct($conn, $aesKey) {
        $this->conn = $conn;
        $this->aesKey = $aesKey;
    }

    public function savePassword($userId, $platform, $plainPassword) {
        // Encrypt password using AES-128-ECB
        $encryptedPassword = openssl_encrypt($plainPassword, "AES-128-ECB", $this->aesKey);

        $stmt = $this->conn->prepare("INSERT INTO passwords (user_id, platform, password_data) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $platform, $encryptedPassword);

        return $stmt->execute();
    }
}
