<?php
include('includes/db.php');
$query = $db->query("SELECT * FROM apartments");
$apartments = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($apartments);
?>
