<?php

$envFile = __DIR__ . '/.env'; 

$servername = $env['DB_HOST'];
$dbname = $env['DB_NAME'];
$username = $env['DB_USER'];
$password = $env['DB_PASS'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>