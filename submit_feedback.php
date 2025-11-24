<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $name = $_POST['name'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO feedback (request_id, name, feedback, rating)
            VALUES ('$request_id', '$name', '$feedback', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3>Thank you for your feedback!</h3>";
        echo "<a href='index.html' class='btn btn-primary mt-3'>Go Home</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>