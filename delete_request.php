<?php
include 'db.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "waste_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // convert to integer
    $sql = "DELETE FROM requests WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php"); // redirect back after deletion
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
