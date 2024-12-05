<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'user') {
    // Redirect to home page if the user is not logged in as a regular user
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Apartmani Dal Mare</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl">User Dashboard</h1>
            <a href="logout.php" class="bg-red-500 py-2 px-4 rounded text-white hover:bg-red-700">Log Out</a>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <p class="text-lg">This is your dashboard. Here you can view your bookings and manage your profile.</p>
            <div class="mt-6">
                <a href="view_bookings.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">View Bookings</a>
                <a href="manage_profile.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 ml-4">Manage Profile</a>
            </div>
        </div>
    </main>

</body>
</html>
