<?php
session_start();
session_unset();  // Clear session
session_destroy();  // Destroy session

echo json_encode(['success' => true]);
?>

