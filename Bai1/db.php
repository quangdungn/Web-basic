<?php
$host = 'localhost'; 
$user = 'root';    
$password = '';      
$dbname = 'flower_db'; 

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
