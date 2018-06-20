<?php
$server = "localhost";
$username = "root";
$password = "";

$connection = new mysqli($server, $username, $password);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Create database visma
$sql = "CREATE DATABASE IF NOT EXISTS visma";
if ($connection->query($sql) === false) {
    echo "Error creating database: " . $connection->error;
    exit;
}

$connection->close();
?>