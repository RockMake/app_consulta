<?php

$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "app_consulta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
