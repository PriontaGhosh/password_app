<?php
// classes/PasswordManager.php

class PasswordManager {
    private $conn;
    private $aesKey;

    public function __construct($conn, $aesKey) {
        $this->conn = $conn;
        $this->aesKey = $aesKey;
    }
}
