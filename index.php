<?php
// Connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search query
$sql = "SELECT * FROM apartments";
$conditions = [];

if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $conditions[] = "apartment_name LIKE '%$search%'";
}

if (!empty($_GET['checkin_date']) && !empty($_GET['checkout_date'])) {
    $checkin_date = $_GET['checkin_date'];
    $checkout_date = $_GET['checkout_date'];
    $conditions[] = "(available_from <= '$checkin_date' AND available_until >= '$checkout_date')";
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$result = $conn->query($sql);
?>

<!-- Display Apartments -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Fetch apartment details
            echo '<div class="border rounded-lg shadow-lg overflow-hidden">';
            echo '<img src="' . $row['image_path'] . '" alt="' . $row['apartment_name'] . '" class="w-full h-48 object-cover">';
            echo '<div class="p-4">';
            echo '<h2 class="text-xl font-bold">' . $row['apartment_name'] . '</h2>';
            echo '<p class="text-gray-700">' . $row['description'] . '</p>';
            echo '<p class="font-semibold text-lg mt-2">Price: $' . $row['price'] . '/night</p>';
            echo '<a href="apartment_detail.php?id=' . $row['id'] . '" class="mt-4 block text-center text-blue-500">View Details</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No apartments found for the selected criteria.</p>";
    }
    ?>
</div>

<?php
$conn->close();
?>
