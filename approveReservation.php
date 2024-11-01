<?php
include('includes/db.php');
$data = json_decode(file_get_contents("php://input"), true);

$reservation_id = $data['reservation_id'];
$status = $data['status']; // 'approved' or 'rejected'

$query = $db->prepare("UPDATE reservations SET status = ? WHERE id = ?");
$query->execute([$status, $reservation_id]);

// Email notification (simple placeholder)
mail($data['email'], "Reservation Status", "Your reservation has been " . $status, "From: no-reply@apartments.com");

echo json_encode(["status" => "success"]);
?>
