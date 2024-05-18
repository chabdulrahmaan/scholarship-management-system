<?php

require_once __DIR__ . '/config.php';

// Connect to database
$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Checks Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
