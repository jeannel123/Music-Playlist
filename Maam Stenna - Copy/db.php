<?php
try {
    // Database connection parameters
    $host = 'srv1761.hstgr.io';
    $db = 'u353731442_music_db'; // Replace with your database name
    $user = 'u353731442_myplaylist';
    $pass = 'JeanicaJeannel620'; // Default password for XAMPP is empty

    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>