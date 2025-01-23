<?php
// Start the session to track the user
session_start();

// Include the database connection file
include('includes/db.php');

// Check if the user is logged in by checking the session variable 'user_id'
// This can be customized based on your login system
$isLoggedIn = isset($_SESSION['user_id']); 

// Retrieve the apartment ID from the URL (using $_GET to get the value from the URL query string)
$apartment_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// If no apartment ID is provided, display an error message and stop execution
if ($apartment_id == 0) {
    die('Invalid apartment ID.');
}

// Prepare and execute the SQL query to get the apartment details from the database
$stmt = $db->prepare("SELECT * FROM apartments WHERE id = :id");
$stmt->bindParam(':id', $apartment_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch the apartment details as an associative array
$apartment = $stmt->fetch(PDO::FETCH_ASSOC);

// If the apartment is not found, display a message and stop the script
if (!$apartment) {
    echo "<p>Apartment not found.</p>";
    exit;
}

// Handle the reservation form submission when the user submits the form (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!$isLoggedIn) {
        // If not logged in, display a message asking the user to log in first
        echo "<p>You must be logged in to make a reservation. <a href='index.php' class='text-blue-500 hover:underline'>Go back to homepage</a></p>";
        exit;
    }

    // Retrieve the check-in and check-out dates from the form
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];

    // Check if the apartment is available for the selected dates by querying the reservations table
    $checkAvailabilitySql = "SELECT * FROM reservations WHERE apartment_id = :apartment_id AND (start_date <= :checkout_date AND end_date >= :checkin_date)";
    $stmt = $db->prepare($checkAvailabilitySql);
    $stmt->bindParam(':apartment_id', $apartment_id, PDO::PARAM_INT);
    $stmt->bindParam(':checkin_date', $checkin_date, PDO::PARAM_STR);
    $stmt->bindParam(':checkout_date', $checkout_date, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch any conflicting reservation
    $reservationConflict = $stmt->fetch(PDO::FETCH_ASSOC);

    // If a reservation conflict is found, show a message and don't allow the reservation
    if ($reservationConflict) {
        echo "<p>This apartment is not available for the selected dates. Please try another date.</p>";
    } else {
        // If there is no conflict, proceed to save the reservation
        $user_id = $_SESSION['user_id'];
        $reservationSql = "INSERT INTO reservations (apartment_id, user_id, start_date, end_date) VALUES (:apartment_id, :user_id, :checkin_date, :checkout_date)";
        $stmt = $db->prepare($reservationSql);
        $stmt->bindParam(':apartment_id', $apartment_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':checkin_date', $checkin_date, PDO::PARAM_STR);
        $stmt->bindParam(':checkout_date', $checkout_date, PDO::PARAM_STR);
        $stmt->execute();

        // Display a confirmation message
        echo "<p>Your reservation has been successfully made!</p>";
    }
}
?>
