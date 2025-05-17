<?php
// classes/User.php

class User {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db; // store db connection when creating the object
    }

    // register new user
    public function register($username, $plainPassword) {
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        // generate AES key based on plain password (keeps it same always)
        $aesKey = openssl_encrypt("static_text", "AES-128-ECB", $plainPassword);

        $stmt = $this->conn->prepare("INSERT INTO users (username, password, aes_key) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $aesKey);
        return $stmt->execute();
    }

    // login existing user
    public function login($username, $plainPassword) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($plainPassword, $row['password'])) {
                // if password is correct, return AES key
                $aesKey = openssl_encrypt("static_text", "AES-128-ECB", $plainPassword);
                if ($aesKey === $row['aes_key']) {
                    return $row; // return full user row
                }
            }
        }
        return false; // wrong login
    }
}
?>
