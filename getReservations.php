<?php
include('includes/db.php');
$apartment_id = $_GET['apartment_id'];
$query = $db->prepare("SELECT * FROM reservations WHERE apartment_id = ?");
$query->execute([$apartment_id]);
$reservations = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($reservations);
?>
