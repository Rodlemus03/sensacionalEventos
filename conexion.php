<?php
$servername = "localhost";  // Si MySQL está en la misma máquina, de lo contrario, proporciona la dirección IP o el nombre de dominio.
$username = "root";   // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$database = "seventos"; // Nombre de tu base de datos
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}



?>