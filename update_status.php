<?php
include 'db.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE requests SET status = '$status' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php"); // Redirect back
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>