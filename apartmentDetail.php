<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get apartment ID from URL
$apartment_id = $_GET['id'];

// Query for apartment details
$sql = "SELECT * FROM apartments WHERE id = $apartment_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container mx-auto p-6">
    <div class="flex justify-center items-center">
        <div class="max-w-lg">
            <h1 class="text-3xl font-bold"><?php echo $row['apartment_name']; ?></h1>
            <p class="text-gray-700 mt-4"><?php echo $row['description']; ?></p>
            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['apartment_name']; ?>" class="mt-4 w-full">
            <p class="text-xl font-semibold mt-4">Price: $<?php echo $row['price']; ?>/night</p>
        </div>
    </div>
</div>

<?php
$conn->close();
?>
