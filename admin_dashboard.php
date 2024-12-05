<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to home page if the user is not logged in as an admin
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Apartmani Dal Mare</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl">Admin Dashboard</h1>
            <a href="logout.php" class="bg-red-500 py-2 px-4 rounded text-white hover:bg-red-700">Log Out</a>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Welcome, Admin!</h2>
            <p class="text-lg">This is your dashboard where you can manage user data, view reservations, and more.</p>
            <div class="mt-6">
                <a href="manage_users.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Manage Users</a>
                <a href="view_reservations.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 ml-4">View Reservations</a>
            </div>
        </div>
    </main>

</body>
</html>
