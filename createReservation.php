<?php
include('includes/db.php');
$data = json_decode(file_get_contents("php://input"), true);

$apartment_id = $data['apartment_id'];
$user_id = $data['user_id'];
$begin_date = $data['begin_date'];
$end_date = $data['end_date'];

$query = $db->prepare("INSERT INTO reservations (apartment_id, user_id, begin_date, end_date, status) VALUES (?, ?, ?, ?, 'pending')");
$query->execute([$apartment_id, $user_id, $begin_date, $end_date]);

// Simple Email notification (replace with actual mail configuration)
mail($data['email'], "Reservation Request", "Your reservation request has been submitted.", "From: no-reply@apartments.com");

echo json_encode(["status" => "success"]);
?>
