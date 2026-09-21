<?php
require '../db_connect.php';
header('Content-Type: application/json');
$stmt = $pdo->query("SELECT name, lat, lng, capacity, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') as created_at FROM evacuation_centers ORDER BY id DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>